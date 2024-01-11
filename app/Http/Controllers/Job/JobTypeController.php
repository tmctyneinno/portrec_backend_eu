<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Base\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Job\Trait\JobTrait;
use App\Models\JobType;
use Illuminate\Http\Request;

class JobTypeController extends BaseController
{
    use JobTrait;
    public function jobTypes($id = null)
    {
        if (!$id) {
            $jobTypes = JobType::withCount($this->jc)->get();
            return $this->successMessage($jobTypes);
        }
        $jobTypes = JobType::findorfail($id);
        $jobs = $jobTypes->jobs()->paginate(10);
        return $this->successMessage([
            "type" => $jobTypes,
            "jobs" => $jobs
        ]);
    }
}
