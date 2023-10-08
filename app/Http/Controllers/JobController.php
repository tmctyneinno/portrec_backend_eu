<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\BaseController;
use App\Models\Industry;
use App\Models\JobFunction;
use App\Models\JobOpening;
use App\Models\WorkType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JobController extends BaseController
{
    public $jc = "jobs as total_jobs";
    public function showJobs($type = null)
    {
        $query = JobOpening::with(["recruiter:id,name,email,phone", "company", "jobType", "sub_category"])->latest();

        if ($type === "latest" || $type = "similar") {
            $latestJobs = $query->take(8)->get();
            // this line is for development purpose only 
            $latestJobs->each(function ($data) {
                $category = Industry::where("id", $data->sub_category->id)->first(['name', 'id']);
                $data->category = $category;
                $data->company->country = Str::random(8);
                $data->company->city = Str::random(8);
                return $data;
            });
            return $this->successMessage($latestJobs);
        }

        $allJobs = $query->paginate(10);
        // for development purpose only
        $allJobs->getCollection()->transform(function ($data) {
            $category = Industry::where("id", $data->sub_category->id)->first(['name', 'id']);
            $data->category = $category;
            $data->company->country = Str::random(8);
            $data->company->city = Str::random(8);
            return $data;
        });
        return $this->successMessage($allJobs);
    }

    public function jobCategories($id = null)
    {
        if (!$id) {
            $categories = Industry::withCount($this->jc)->get();
            return $this->successMessage($categories);
        }
        $categories = Industry::findorfail($id);
        $jobs = $categories->jobs()->paginate(10);
        return $this->successMessage([
            "category" => $categories,
            "jobs" => $jobs
        ]);
    }

    public function jobTypes($id = null)
    {
        if (!$id) {
            $jobTypes = WorkType::withCount($this->jc)->get();
            return $this->successMessage($jobTypes);
        }
        $jobTypes = WorkType::findorfail($id);
        $jobs = $jobTypes->jobs()->paginate(10);
        return $this->successMessage([
            "type" => $jobTypes,
            "jobs" => $jobs
        ]);
    }

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

    public function jobDetails($id)
    {
        $job = JobOpening::where("id", $id)->with(["questions", "sub_category", "jobType", "company"])->first();
        $category = Industry::where("id", $job->sub_category->id)->first(['name', 'id']);
        $job->category = $category;
        $job->company->city = Str::random(8);
        $job->company->country = Str::random(8);
        return $this->successMessage($job);
    }

    public function jobSalaryRansge($from, $to)
    {
        if ($from > $to) return $this->errorMessage("min value cannot be greater than max value");
        $allJobs = JobOpening::with(["recruiter:id,name,email,phone", "company", "jobType", "sub_category"])->where("min_salary", "<", $from)->where("max_salary", ">", $to)->get();
        return $this->successMessage($allJobs);
    }
}
