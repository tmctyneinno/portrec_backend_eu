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
        $validate = $request->validated();
        $id = $this->userID()->id;
        $request['user_id'] = $id;
        $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date);

        $request['start_date'] = $start->format("Y-m-d H:i:s");
        $request['end_date'] = $end->format("Y-m-d H:i:s");
        $edu = Education::create($validate);
        return $this->successMessage($edu);
    }

    public function updateEducation(EducationUpdateRequest $request, $id)
    {
        $validate = $request->validated();
        $userId = $this->userID()->id;
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
