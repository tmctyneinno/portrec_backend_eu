<?php

namespace App\Http\Controllers\Users\Job;

use App\Http\Controllers\Base\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\Job\Trait\JobTrait;
use App\Models\Industry;
use Illuminate\Http\Request;

class JobCategoryController extends BaseController
{
    use JobTrait;
    public function category($id = null)
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
}
