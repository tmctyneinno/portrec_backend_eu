<?php

namespace App\Http\Controllers\User;

use App\Helper\FileUpload;
use App\Http\Controllers\Base\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\Trait\UserTrait;
use App\Models\ProfilePicture;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProfileController extends BaseController
{
    use UserTrait;
    public function myProfile()
    {
        $user = $this->UserID();

        $associations = ["experience", "cover_letters", "resume", "profile_pic", "education"];
        $profile = User::with($associations)->find($user->id);
        $profile['skills'] = $profile->skill->each(function ($data) {
            $data["name"] = Skill::find($data['skill_id'])->name;
        });
        return $this->successMessage($profile, "profile updated", 201);
    }

    public function updateProfile(Request $request)
    {
        $not_allowed = ["password", "industries_id", "email", "user_level_id", "user_id"];
        $id = $this->userID()->id;

        User::where("id", $id)->update($request->except($not_allowed));
        return $this->successMessage($request->except($not_allowed), "profile updated", 201);
    }

    public function uploadProfileImage(Request $request, $id = "")
    {
        $userId = $this->userID()->id;

        $resp = FileUpload::uploadFile($request->file("img"), "profile_pic");

        if ($resp instanceof Response) return $resp;

        if (!$id) {
            $request['image'] = $resp;
            $request['user_id'] = $userId;
            $upload = ProfilePicture::create($request->all());
            return $this->successMessage($upload);
        }

        ProfilePicture::where($this->condition($id, $userId))->update(["image" => $resp]);
        return $this->successMessage($resp);
    }
}