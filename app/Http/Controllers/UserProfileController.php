<?php

namespace App\Http\Controllers;

use App\Helper\FileUpload;
use App\Http\Controllers\Base\BaseController;
use App\Models\AcquiredSkill;
use App\Models\CoverLetter;
use App\Models\Education;
use App\Models\Portfolio;
use App\Models\ProfilePicture;
use App\Models\Skill;
use App\Models\User;
use App\Models\UserResume;
use App\Models\WorkExperience;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;


class UserProfileController extends BaseController
{
    public function userID($type = "update")
    {
        $user = auth()->user();
        $this->authorize($type, $user);
        return $user;
    }

    public function condition($id, $userId)
    {
        return [["id", "=", $id], ["user_id", "=",  $userId]];
    }

    public function myProfile()
    {
        $id = $this->userID()->id;
        $result = User::with(['profile_pic', 'education', 'resume', 'cover_letters'])->find($id);
        return $this->successMessage($result);
    }

    public function updateProfile(Request $request)
    {
        $not_allowed = ["password", "industries_id", "email", "user_level_id"];
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

    public function skill(Request $request)
    {
        $id = $this->userID()->id;
        $request['user_id'] = $id;
        $skill = AcquiredSkill::create($request->all());
        return $this->successMessage($skill, "success", 201);
    }

    public function updateSkill(Request $request, $id)
    {
        $userId = $this->userID()->id;
        $skill = AcquiredSkill::where($this->condition($id, $userId))->update($request->except("user_id"));
        return $this->successMessage($skill, "success", 201);
    }

    public function getSkills(Request $request)
    {
        $userId = $this->userID()->id;
        $skills = AcquiredSkill::with('skill')->where(['user_id' => $userId])->get();
        return $this->successMessage($skills, "success");
    }

    public function education(Request $request)
    {
        $id = $this->userID()->id;
        $request['user_id'] = $id;
        $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date);

        $request['start_date'] = $start->format("Y-m-d H:i:s");
        $request['end_date'] = $end->format("Y-m-d H:i:s");
        $edu = Education::create($request->all());
        return $this->successMessage($edu);
    }

    public function updateEducation(Request $request, $id)
    {
        $userId = $this->userID()->id;
        $edu = Education::where($this->condition($id, $userId))->update($request->all());
        return $this->successMessage($edu);
    }

    public function deleteEducation($id)
    {
        $userId = $this->userID()->id;
        $edu = Education::where($this->condition($id, $userId))->delete();
        return $this->successMessage($edu, "", 204);
    }

    public function uploadResume(Request $request)
    {
        $userId = $this->userID()->id;
        $resp = FileUpload::uploadFile($request->file("file"), "resume");
        if ($resp instanceof Response) return $resp;

        $request['doc_url'] = $resp;
        $request['user_id'] = $userId;
        $request['doc_name'] = $request->name ?? "";
        $upload = UserResume::create($request->all());
        return $this->successMessage($upload);
    }

    public function deleteResume($id)
    {
        $userId =  $this->userID()->id;
        UserResume::where([
            "id", "=", $id,
            "user_id", "=",  $userId
        ])->delete();
        return $this->successMessage("", "", 204);
    }

    public function portfolio(Request $request)
    {
        $id = $this->userID()->id;
        $request['user_id'] = $id;
        $portfolio = Portfolio::create($request->all());
        return $this->successMessage($portfolio, "", 204);
    }

    public function uploadCoverLetter(Request $request)
    {
        $userId = $this->userID()->id;

        $resp = FileUpload::uploadFile($request->file("file"), "coverLetters");
        if ($resp instanceof Response) return $resp;

        $request['doc_url'] = $resp;
        $request['user_id'] = $userId;

        $upload = CoverLetter::create($request->all());
        return $this->successMessage($upload);
    }

    public function writeCoverLetter(Request $request)
    {
        $id = $this->userID()->id;
        $request['user_id'] = $id;
        $resume = CoverLetter::create($request->all());
        return $this->successMessage($resume);
    }

    public function updateCoverLetter(Request $request, $id)
    {
        $userId = $this->userID()->id;
        $letter = CoverLetter::where($this->condition($id, $userId))->update($request->all());
        return $this->successMessage($letter);
    }

    public function deleteCoverLetter($id)
    {
        $userId = $this->userID()->id;
        CoverLetter::where($this->condition($id, $userId))->delete();
        return $this->successMessage("", "", 204);
    }

    public function workExperience(Request $request)
    {
        $id = $this->userID()->id;
        $request['user_id'] = $id;
        $experience = WorkExperience::create($request->all());
        return $this->successMessage($experience);
    }

    public function updateExperience(Request $request, $id)
    {
        $userId = $this->userID()->id;
        WorkExperience::where($this->condition($id, $userId))->update($request->all());
        return $this->successMessage("", "", 204);
    }

    public function deleteExperience($id)
    {
        $userId = $this->userID()->id;
        WorkExperience::where($this->condition($id, $userId))->delete();
        return $this->successMessage("", "", 204);
    }
}
