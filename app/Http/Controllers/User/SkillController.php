<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Base\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\Trait\UserTrait;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends BaseController
{
    use UserTrait;

    public function skill(Request $request)
    {
        $id = $this->userID()->id;
        $request['user_id'] = $id;
        $skill = Skill::create($request->all());
        return $this->successMessage($skill, "success", 201);
    }

    public function updateSkill(Request $request, $id)
    {
        $userId = $this->userID()->id;
        $skill = Skill::where($this->condition($id, $userId))->update($request->except("user_id"));
        return $this->successMessage($skill, "success", 201);
    }
}
