<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Base\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\Trait\UserTrait;
use App\Http\Requests\SkillRequest;
use App\Models\AcquiredSkill;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends BaseController
{
    use UserTrait;

    public function skill(SkillRequest $request)
    {
        $request->validated();
        $id = $this->userID()->id;
        $request['user_id'] = $id;
        $skill = AcquiredSkill::create($request->all());
        return $this->successMessage($skill, "success", 201);
    }

    public function deleteSkill($id)
    {

        $userId = $this->userID()->id;
        $skill = AcquiredSkill::where("id", $id)->where("user_id", $userId)->delete();
        return $this->successMessage($skill, "success", 204);
    }

    public function getSkills()
    {
        $userId = $this->userID()->id;
        $skills = AcquiredSkill::where(['user_id' => $userId])->get();

        $skills->each(function ($sk) {
            $sk['skill'] = Skill::where("id", $sk->skill_id)->first();
            return $sk;
        });

        return $this->successMessage($skills, "success");
    }
}
