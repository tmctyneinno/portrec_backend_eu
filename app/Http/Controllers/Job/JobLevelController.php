<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Base\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Job\Trait\JobTrait;
use App\Models\JobLevel;
use Illuminate\Http\Request;

class JobLevelController extends BaseController
{
    use JobTrait;
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
}
