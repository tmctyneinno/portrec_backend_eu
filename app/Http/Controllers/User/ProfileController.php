<?php

namespace App\Http\Controllers\User;

use App\Helper\FileUpload;
use App\Http\Controllers\Base\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\Trait\UserTrait;
use App\Models\ProfilePicture;
use App\Models\Skill;
use App\Models\User;
use App\Services\CloudinaryFileUploadService;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class ProfileController extends BaseController
{
    use UserTrait;
    public function myProfile()
    {
        $user = $this->UserID();

        $associations = ["experience", "cover_letters", "resume", "education"];
        $profile = User::with($associations)->find($user->id);
        $profile['skills'] = $profile->skill->each(function ($data) {
            $data["name"] = Skill::find($data['skill_id'])->name;
        });
        return $this->successMessage($profile, "profile updated", 201);
    }

    public function updateProfile(Request $request)
    {
        $not_allowed = ["password", "industries_id", "email", "user_level_id", "user_id", "phone"];
        $id = $this->userID()->id;
        $user = User::where("id", $id)->first();
        if($request->image){
            $fileUplaod = new CloudinaryFileUploadService;
            $upload = $fileUplaod->upload($request->image, '');
        }
        $data = $this->UserDetails($request,  $upload??null);
        UserProfile::whereUserId($id)->first()->fill($data)->save();

        return $this->successMessage(['user' =>$user, 'profile' => $user->profile], "profile updated", 201);
    }

    // public function uploadProfileImage(Request $request, $id = "")
    // {
    //     $userId = $this->userID()->id;

    //     $resp = FileUpload::uploadFile($request->file("img"), "profile_pic");

    //     if ($resp instanceof Response) return $resp;

    //     if (!$id) {
    //         $request['image'] = $resp;
    //         $request['user_id'] = $userId;
    //         $upload = ProfilePicture::create($request->all());
    //         return $this->successMessage($upload);
    //     }

    //     ProfilePicture::where($this->condition($id, $userId))->update(["image" => $resp]);
    //     return $this->successMessage($resp);
    // }

    public function updatePassword(Request $request)
    {
        $userId = $this->userID()->id;
        $user = User::find($userId)->first();
        $oldPassword = Hash::check($request->oldPassword, $user->password);
        if (!$oldPassword) {
            return $this->errorMessage("wrong old password");
        }
        $user->password = Hash::make($request->newPassword);
        $user->save();
        return $this->successMessage("", "password update success");
    }
}
