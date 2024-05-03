<?php

namespace App\Http\Controllers\Users\Job;

use App\Http\Controllers\Base\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\Job\Trait\JobTrait;
use App\Models\JobFunction;
use Illuminate\Http\Request;

class JobFunctionController extends BaseController
{
    use JobTrait;
    public function jobFunctions($id = null)
    {
        if (!$id) {
            $jobFunc = JobFunction::withCount($this->jc)->get();
            return $this->successMessage($jobFunc);
        }

        $jobs = JobFunction::findorfail($id);
        $subJob = $jobs->jobs()->paginate(5);
        return  $this->successMessage([
            "sub_category" => $jobs,
            "jobs" => $subJob
        ]);
    }
}
