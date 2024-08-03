<?php

namespace App\Http\Controllers\Recruiters;

use App\Http\Controllers\Base\BaseController;
use App\Http\Controllers\Recruiters\Trait\RecruiterTrait;
use App\Http\Requests\JobOpeningRequest;
use App\Models\Industry;
use App\Models\JobFunction;
use App\Models\JobLevel;
use App\Models\JobOpening;
use App\Models\JobType;
use App\Models\RecruiterProfile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JobController extends BaseController
{

    use RecruiterTrait;
    public $jc = "jobs as total_jobs";

    private function filter($query, $table, $delimeter, $pointer = "id"): void
    {
        if ($delimeter)
            $query->whereHas($table, function ($query) use ($delimeter, $pointer) {
                $query->whereIn($pointer, [$delimeter]);
            });
    }
    public function showJobs(Request $request)
    {

        $id = $this->RecruiterID()->id;
        $profile = RecruiterProfile::where('recruiter_id', $id)->first();
        $query = JobOpening::with(["recruiter:id,name,email,phone", "company", "jobType", "industry"]);
        $search = $request->get("search");
        $start_date = $request->get("start_date") ?? Carbon::now()->toDateString();
        $end_date = $request->get("end_date") ??  Carbon::now()->addDays(30)->toDateString();


        $query->whereBetween('deadline', [$start_date, $end_date]);

        if ($profile)
            $query->where('company_id', $profile->company_id);


        if ($search)
            $query->where("title", "like", "%" .  $search . "%");

        $allJobs = $query->paginate(10);

        return $this->successMessage($allJobs);
    }


    public function postJobOpening(JobOpeningRequest $request)
    {
        $validatedData = $request->validated();
        $jobOpening = JobOpening::create(array_merge($validatedData, ['recruiter_id' => $request->user()->id]));
        return response()->json($jobOpening, 201);
    }


    public function updateJobOpening(JobOpeningRequest $request, $id)
    {
        $validatedData = $request->validated();
        $jobOpening = JobOpening::find($id);
        $jobOpening->update($validatedData);
        return response()->json($jobOpening, 201);
    }

    public function deleteJobOpening($id)
    {
        $jobOpening = JobOpening::find($id);
        $jobOpening->delete();
        return response()->json($jobOpening, 200);
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
