<?php

namespace App\Http\Controllers;

use App\Models\JobOpening;
use Illuminate\Http\Request;
use App\Enums\FeatureJobs;

class FeatureJobsController extends Controller
{
    //

    public function featureJobs()
    {
        $jobs = JobOpening::where('is_featured', FeatureJobs::isFeatured)->paginate(20);
        return response()->json(['data' => $jobs], 200); 
    }
}
