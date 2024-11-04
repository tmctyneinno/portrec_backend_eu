<?php

namespace App\Http\Controllers\Recruiters;

use App\Helper\FileUpload;
use App\Http\Controllers\Base\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Recruiters\Trait\RecruiterTrait;
use App\Models\FileUploadPath;
use App\Models\Recruiter;
use App\Models\RecruiterProfile;
use App\Services\Users\CloudinaryFileUploadService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class ProfileController extends BaseController
{
    use RecruiterTrait;
    public function myProfile()
    {
        $recruiter = $this->RecruiterID();
        $associations = ['profile'];
        $profile = Recruiter::with($associations)->find($recruiter->id);

        $avatar = FileUploadPath::find($profile->profile->avatar);
        $profile['avatar'] =  $avatar?->url ?? null;

        return $this->successMessage($profile, "profile updated", 201);
    }

    public function updateProfile(Request $request)
    {
        $id = $this->RecruiterID()->id;
        $recruiter = Recruiter::where("id", $id)->first();
        if ($request->image_path) {
            $fileUplaod = new CloudinaryFileUploadService;
            $upload = $fileUplaod->upload($request->image_path, 'profile');
        }

        $data = $this->RecruiterDetails($request, $upload[1] ?? null);
        $profile = RecruiterProfile::where('recruiter_id', $id)->first();

        if ($profile) {
            $profile->fill($data)->save();
        } else {
            $data['recruiter_id'] = $id;
            RecruiterProfile::create($data);
        }

        $recruiter->update($request->all());

        return $this->successMessage(['recruiter' => $recruiter, 'profile' => $recruiter->profile], "profile updated", 201);
    }


    public function updatePassword(Request $request)
    {
        $id = $this->RecruiterID()->id;
        $recruiter = Recruiter::find($id);
        $oldPassword = Hash::check($request->oldPassword, $recruiter->password);
        if (!$oldPassword) {
            return $this->errorMessage("wrong old password", 401);
        }
        $recruiter->password = Hash::make($request->newPassword);
        $recruiter->save();
        return $this->successMessage("", "password update success", 201);
    }


    public function uploadProfileImage(Request $request)
    {
        $id = $this->RecruiterID()->id;
        $folder_path = 'profile_pics';

        $profile = RecruiterProfile::where('recruiter_id', $id)->first();

        // delete existing photo
        if ($profile->avatar) {
            $profilePic = $profile->FileUploadPath;
            FileUpload::deleteFileInPath($profilePic->folder_path, $profilePic->name);
        }

        // upload the new file and URL
        $fileUploaded = FileUpload::uploadFileToPath($request, 'img', $folder_path);
        $FileUploadPath = FileUploadPath::updateOrCreate(
            ['id' => $profile->avatar],
            [
                'name' => $fileUploaded['name'],
                'folder_path' => $folder_path,
                'url' => $fileUploaded['url'],
            ]
        );

        // update avatar
        $profile->update(["avatar" => $FileUploadPath->id]);

        return $this->successMessage($fileUploaded);
    }
}
