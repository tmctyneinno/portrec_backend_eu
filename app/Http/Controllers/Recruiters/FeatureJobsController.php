<?php

namespace App\Http\Controllers\Recruiters;

use App\Models\JobOpening;
use Illuminate\Http\Request;
use App\Enums\FeaturedJobs;

use App\Http\Controllers\Controller;
class FeatureJobsController extends Controller
{
    //

    public function featureJobs()
    {
        $jobs = JobOpening::where('is_featured', FeaturedJobs::isFeatured)->paginate(20);
        return response()->json(['data' => $jobs], 200); 
    }
}
