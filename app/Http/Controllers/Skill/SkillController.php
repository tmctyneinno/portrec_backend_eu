<?php

namespace App\Http\Controllers\Skill;

use App\Http\Controllers\Base\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends BaseController
{
    public function getSkill()
    {
        return $this->successMessage(Skill::all());
    }
}
