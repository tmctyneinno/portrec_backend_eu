<?php

namespace App\Http\Controllers;

use App\Models\JobOpening;
use Illuminate\Http\Request;
use App\Enums\FeaturedJobs;

class FeatureJobsController extends Controller
{
    //

    public function featureJobs()
    {
        $jobs = JobOpening::where('is_featured', FeaturedJobs::isFeatured)->paginate(20);
        return response()->json(['data' => $jobs], 200); 
    }
}
