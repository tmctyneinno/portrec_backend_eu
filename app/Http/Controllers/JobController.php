<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\BaseController;
use App\Models\Industry;
use App\Models\JobFunction;
use App\Models\JobOpening;
use App\Models\WorkType;
use Illuminate\Http\Request;

class JobController extends BaseController
{
    public $jc = "jobs as total_jobs";
    public function showJobs()
    {
        $allJobs = JobOpening::with(["recruiter:id,name,email,phone", "company", "jobType", "title"])->paginate(15);
        return $this->successMessage($allJobs);
    }

    public function filterJobs()
    {
    }

    public function jobCategories()
    {
        $categories = Industry::withCount($this->jc)->get();
        return $this->successMessage($categories);
    }

    public function jobTypes()
    {
        $jobTypes = WorkType::withCount($this->jc)->get();
        return $this->successMessage($jobTypes);
    }

    public function jobLevels()
    {
    }

    public function jobFunctions($id = null)
    {
        if ($id) {
            $jobs = JobFunction::findorfail($id);
            $subJob = $jobs->jobs()->paginate(5);
            return  $this->successMessage($subJob);
        }

        $jobFunc = JobFunction::withCount($this->jc)->get();
        return $this->successMessage($jobFunc);
    }

    public function jobDetails($id)
    {
        $job = JobOpening::where("id", $id)->with("questions")->first();
        return $this->successMessage($job);
    }
}
