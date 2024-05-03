<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Base\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\Trait\UserTrait;
use App\Http\Requests\ExperienceRequest;
use App\Http\Requests\ExperienceUpdateRequest;
use App\Models\WorkExperience;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class WorkExperienceController extends BaseController
{
    use UserTrait;
    public function workExperience(ExperienceRequest $request)
    {
        $id = $this->userID()->id;
        $validated = $request->validated();

        $start = Carbon::parse($request->start_date);
        $end = $request->end_date ? Carbon::parse($request->end_date) : null;

        $validated['start_date'] = $start->format("Y-m-d H:i:s");
        $validated['end_date'] = $end ? $end->format("Y-m-d H:i:s") : null;

        $validated['user_id'] = $id;
        $experience = WorkExperience::create($validated);
        return $this->successMessage($experience);
    }

    public function updateExperience(ExperienceUpdateRequest $request, $id)
    {
        $userId = $this->userID()->id;
        $validated = $request->validated();

        if ($request->start_date) {
            $start = Carbon::parse($validated['start_date']);
            $validated['start_date'] = $start->format("Y-m-d H:i:s");
        }

        if ($request->end_date) {
            $end = Carbon::parse($validated['end_date']);
            $validated['end_date'] = $end->format("Y-m-d H:i:s");
        }

        $validated["user_id"] = $userId;
        WorkExperience::where($this->condition($id, $userId))->update($validated);
        return $this->successMessage("", "update success");
    }

    public function deleteExperience($id)
    {
        $userId = $this->userID()->id;
        WorkExperience::where($this->condition($id, $userId))->delete();
        return $this->successMessage("", "", 204);
    }
}
