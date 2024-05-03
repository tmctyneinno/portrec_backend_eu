<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Base\BaseController;
use App\Models\Industry;
use App\Models\JobFunction;
use App\Models\JobLevel;
use App\Models\JobOpening;
use App\Models\JobType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JobController extends BaseController
{
    public $jc = "jobs as total_jobs";

    private function filter($query, $table, $delimeter, $pointer = "id"): void
    {
        if ($delimeter)
            $query->whereHas($table, function ($query) use ($delimeter, $pointer) {
                $query->whereIn($pointer, [$delimeter]);
            });
    }
    public function showJobs(Request $request, $type = null, $id = null)
    {

        $query = JobOpening::with(["recruiter:id,name,email,phone", "company", "jobType", "industry"]);

        if (!$type) {
            $jobType = $request->get("type_id");
            $industry = $request->get("industry_id");
            $min = $request->get("min_salary");
            $max = $request->get("max_salary");

            if ($min & $max) {
                $query->where("min_salary", ">=", [$min])->where("max_salary", "<=", [$max]);
            }

            $this->filter($query, "jobType", $jobType);
            $this->filter($query, "industry", $industry);

            $allJobs = $query->paginate(10);


            // for development purpose only
            // $allJobs->getCollection()->transform(function ($data) {
            //     $category = Industry::where("id", $data->industry_id)->first(['name', 'id']);
            //     $data->category = $category;
            //     $data->company->country = Str::random(8);
            //     $data->company->city = Str::random(8);
            //     return $data;
            // });
            

            return $this->successMessage($allJobs);
        }

        if ($type === "similar" && $id) {
            $this->filter($query, "industry", $id);
            $similarJobs =  $query->inRandomOrder()->take(8)->get();

            // for devlopmwnt purpose only
            $similarJobs->each(function ($data) {
                $category = Industry::where("id", $data->industry_id)->first(['name', 'id']);
                $data->category = $category;
                $data->company->country = Str::random(8);
                $data->company->city = Str::random(8);
                return $data;
            });

            return $this->successMessage($similarJobs);
        }

        if ($type === "latest") {
            $latestJobs = $query->take(8)->latest()->get();

            // this line is for development purpose only 
            $latestJobs->each(function ($data) {
                $category = Industry::where("id", $data->industry_id)->first(['name', 'id']);
                $data->category = $category;
                $data->company->country = Str::random(8);
                $data->company->city = Str::random(8);
                return $data;
            });
            return $this->successMessage($latestJobs);
        }
    }

    public function jobIndustries($id = null)
    {
        if (!$id) {
            $categories = Industry::withCount('jobs as total_jobs')->get();
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
        $job = JobOpening::where("id", $id)->with(["questions", "industry", "jobType", "company"])->first();
        // $category = Industry::where("id", $job->sub_category->id)->first(['name', 'id']);
        // $job->category = $category;
        // $job->company->city = Str::random(8);
        // $job->company->country = Str::random(8);
        return $this->successMessage($job);
    }

    public function jobSalaryRansge($from, $to)
    {
        if ($from > $to) return $this->errorMessage("min value cannot be greater than max value");
        $allJobs = JobOpening::with(["recruiter:id,name,email,phone", "company", "jobType", "industry"])->where("min_salary", "<", $from)->where("max_salary", ">", $to)->get();
        return $this->successMessage($allJobs);
    }

    public function jobLevels($id = null)
    {
        if (!$id) {
            $joblevel = JobLevel::withCount($this->jc)->get();
            return $this->successMessage($joblevel);
        }
        $joblevel = JobLevel::findorfail($id);
        $jobs = $joblevel->jobs()->paginate(10);
        return $this->successMessage([
            "type" => $joblevel,
            "jobs" => $jobs
        ]);
    }

    public function jobSearch(Request $request)
    {
        $title = $request->get("title");
        $location = $request->get("location");
        $query = JobOpening::with(["recruiter:id,name,email,phone", "company", "jobType", "industry"]);

        if ($title)
            $query->where("title", "like", "%" .  $title . "%");
        if ($location)
            $query->where("location",  "like",  "%" . $location . "%");

        $search = $query->paginate(10);
        return $this->successMessage($search);
    }
}
