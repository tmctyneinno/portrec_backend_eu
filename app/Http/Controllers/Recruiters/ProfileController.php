<?php

namespace App\Http\Controllers\Recruiters;

use App\Helper\FileUpload;
use App\Http\Controllers\Base\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Recruiters\Trait\RecruiterTrait;
use App\Models\ProfilePicture;
use App\Models\Recruiter;
use App\Models\RecruiterProfile;
use App\Models\Skill;
use App\Models\User;
use App\Services\Users\CloudinaryFileUploadService;
use App\Models\UserProfile;
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
        $profile = RecruiterProfile::whereRecruiterId($id)->first();

        if ($profile) {
            $profile->fill($data)->save();
        } else {
            // Create a new UserProfile if it doesn't exist
            $data['recruiter_id'] = $id;
            UserProfile::create($data);
        }
        return $this->successMessage(['recruiter' => $recruiter, 'profile' => $recruiter->profile], "profile updated", 201);
    }


    public function updatePassword(Request $request)
    {
        $id = $this->RecruiterID()->id;
        $recruiter = Recruiter::find($id)->first();
        $oldPassword = Hash::check($request->oldPassword, $recruiter->password);
        if (!$oldPassword) {
            return $this->errorMessage("wrong old password");
        }
        $recruiter->password = Hash::make($request->newPassword);
        $recruiter->save();
        return $this->successMessage("", "password update success");
    }
}
