<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Base\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Job\Trait\JobTrait;
use App\Models\Industry;
use App\Models\JobOpening;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JobController extends BaseController
{
    use JobTrait;
    public function all(Request $request, $type = null, $id = null)
    {
        $query = JobOpening::with(["recruiter:id,name,email,phone", "company", "jobType", "sub_category"]);
        $query = JobOpening::with(["recruiter:id,name,email,phone", "company", "jobType", "sub_category"]);

        if (!$type) {
            $jobType = $request->get("type_id");
            $category = $request->get("cat_id");
            $min = $request->get("min_salary");
            $max = $request->get("max_salary");

            if ($min & $max) {
                $query->where("min_salary", ">=", [$min])->where("max_salary", "<=", [$max]);
            }

            $this->filter($query, "jobType", $jobType);
            $this->filter($query, "sub_category", $category, "industry_id");

            $allJobs = $query->paginate(10);

            // for development purpose only
            $allJobs->getCollection()->transform(function ($data) {
                $category = Industry::where("id", $data->sub_category->industry_id)->first(['name', 'id']);
                $data->category = $category;
                $data->company->country = Str::random(8);
                $data->company->city = Str::random(8);
                return $data;
            });

            return $this->successMessage($allJobs);
        }

        if ($type === "similar" && $id) {
            $this->filter($query, "sub_category", $id);
            $similarJobs =  $query->inRandomOrder()->take(8)->get();

            // for devlopmwnt purpose only
            $similarJobs->each(function ($data) {
                $category = Industry::where("id", $data->sub_category->industry_id)->first(['name', 'id']);
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
                $category = Industry::where("id", $data->sub_category->industry_id)->first(['name', 'id']);
                $data->category = $category;
                $data->company->country = Str::random(8);
                $data->company->city = Str::random(8);
                return $data;
            });
            return $this->successMessage($latestJobs);
        }
    }

    public function detail($id)
    {
        $job = JobOpening::where("id", $id)->with(["questions", "sub_category", "jobType", "company"])->first();
        $category = Industry::where("id", $job->sub_category->id)->first(['name', 'id']);
        $job->category = $category;
        $job->company->city = Str::random(8);
        $job->company->country = Str::random(8);
        return $this->successMessage($job);
    }
}
