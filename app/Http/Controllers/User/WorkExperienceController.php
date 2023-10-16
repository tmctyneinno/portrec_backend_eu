<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Base\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\Trait\UserTrait;
use App\Http\Requests\ExperienceRequest;
use App\Http\Requests\ExperienceUpdateRequest;
use App\Models\WorkExperience;
use Illuminate\Http\Request;

class WorkExperienceController extends BaseController
{
    use UserTrait;
    public function workExperience(ExperienceRequest $request)
    {
        $request->validated();
        $id = $this->userID()->id;
        $request['user_id'] = $id;
        $experience = WorkExperience::create($request->all());
        return $this->successMessage($experience);
    }

    public function updateExperience(ExperienceUpdateRequest $request, $id)
    {
        $validated = $request->validated();

        $userId = $this->userID()->id;
        WorkExperience::where($this->condition($id, $userId))->update($validated);
        return $this->successMessage("", "", 204);
    }

    public function deleteExperience($id)
    {
        $userId = $this->userID()->id;
        WorkExperience::where($this->condition($id, $userId))->delete();
        return $this->successMessage("", "", 204);
    }
}
