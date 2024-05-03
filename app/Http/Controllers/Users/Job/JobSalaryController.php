<?php

namespace App\Http\Controllers\Users\Job;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\Job\Trait\JobTrait;
use App\Models\JobOpening;
use Illuminate\Http\Request;

class JobSalaryController extends Controller
{
    use JobTrait;
    public function jobSalaryRansge($from, $to)
    {
        if ($from > $to) return $this->errorMessage("min value cannot be greater than max value");
        $allJobs = JobOpening::with(["recruiter:id,name,email,phone", "company", "jobType", "sub_category"])->where("min_salary", "<", $from)->where("max_salary", ">", $to)->get();
        return $this->successMessage($allJobs);
    }
}
