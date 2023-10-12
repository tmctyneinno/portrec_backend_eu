<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Base\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Job\Trait\JobTrait;
use App\Models\JobOpening;
use Illuminate\Http\Request;

class JobSearchController extends BaseController
{
    use JobTrait;
    public function jobSearch(Request $request)
    {
        $title = $request->get("title");
        $location = $request->get("location");
        $query = JobOpening::with(["recruiter:id,name,email,phone", "company", "jobType", "sub_category"]);

        if ($title)
            $query->where("title", "like", "%" .  $title . "%");
        if ($location)
            $query->where("location",  "like",  "%" . $location . "%");

        $search = $query->paginate(10);
        return $this->successMessage($search);
    }
}
