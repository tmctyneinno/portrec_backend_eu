<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Base\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\Trait\UserTrait;
use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EducationController extends BaseController
{
    use UserTrait;
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
}
