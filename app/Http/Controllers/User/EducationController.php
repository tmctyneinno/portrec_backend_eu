<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Base\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\Trait\UserTrait;
use App\Http\Requests\EducationRequest;
use App\Http\Requests\EducationUpdateRequest;
use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EducationController extends BaseController
{
    use UserTrait;
    public function education(EducationRequest $request)
    {
        $id = $this->userID()->id;
        $validate = $request->validated();

        $request['user_id'] = $id;
        $start = Carbon::parse($request->start_date);
        $end = $validate['end_date'] ? Carbon::parse($validate['end_date']) : null;

        $validate['start_date'] = $start->format("Y-m-d H:i:s");
        $validate['end_date'] = $end ? $end->format("Y-m-d H:i:s") : null;
        $validate['user_id'] = $id;

        $edu = Education::create($validate);
        return $this->successMessage($edu);
    }

    public function updateEducation(EducationUpdateRequest $request, $id)
    {
        $userId = $this->userID()->id;
        $validate = $request->validated();

        if ($validate['start_date']) {
            $start = Carbon::parse($validate['start_date']);
            $validate['start_date'] = $start->format("Y-m-d H:i:s");
        }

        if ($validate['end_date']) {
            $end = Carbon::parse($validate['end_date']);
            $validate['start_date'] = $end->format("Y-m-d H:i:s");
        }

        $edu = Education::where($this->condition($id, $userId))->update($validate);
        return $this->successMessage($edu);
    }

    public function deleteEducation($id)
    {
        $userId = $this->userID()->id;
        $edu = Education::where($this->condition($id, $userId))->delete();
        return $this->successMessage($edu, "", 204);
    }
}
