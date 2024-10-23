<?php

namespace App\Services\Users;

use App\Dtos\UserRegistrationDto;
use App\Enums\JobApplicationStatus;
use App\Http\Controllers\Recruiters\Trait\RecruiterTrait;
use App\Http\Controllers\Users\Trait\UserTrait;
use App\Interfaces\DashboardServiceInterface;
use App\Models\CoverLetter;
use App\Models\JobApplication;
use App\Models\User;
use App\Models\Recruiter;
use App\Models\UserResume;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DashboardService implements DashboardServiceInterface
{

    public function RecruiterDashboardInfo($request): array
    {
        $id = $request->user()->id;
        return [];
    }

    public function UserDashboardInfo($request): array
    {

        // $start_date = $request->start_date ? Carbon::parse($request->start_date)->toDateString() : Carbon::now()->toDateString();
        // $end_date = $request->end_date ? Carbon::parse($request->end_date)->toDateString() : Carbon::now()->toDateString();

        $id = $request->user()->id;

        $jobApplicationsQuery = JobApplication::with(['user', 'job'])
            ->where('user_id', $id)
            ->whereNotNull('status')
            ->orderBy('created_at', 'desc');

        $jobApplications = $jobApplicationsQuery->get();

        $totalJobsApplied = $jobApplications->count();
        $recentApplicationHistory = $jobApplications->take(5)->map(function ($item) {
            $item['company'] = $item->job->company;
            return $item;
        });
        $totalJobsViewed = $jobApplicationsQuery->where('is_viewed', 1)->count();
        $totalJobsRejected = $jobApplicationsQuery->where('status', JobApplicationStatus::REJECTED->value)->count();

        return [
            'recentApplicationHistory' => $recentApplicationHistory,
            'totalJobsRejected' => $totalJobsRejected,
            'totalJobsApplied' => $totalJobsApplied,
            'totalJobsViewed' => $totalJobsViewed,
        ];
    }

    public function UserUpcomingInterviews($request): array
    {
        // $start_date = $request->start_date ? Carbon::parse($request->start_date)->toDateString() : Carbon::now()->toDateString();
        // $end_date = $request->end_date ? Carbon::parse($request->end_date)->toDateString() : Carbon::now()->toDateString();

        $id = $request->user()->id;

        $jobApplications = JobApplication::with(['user', 'job'])
            ->where('user_id', $id)
            ->whereNotNull('status')
            ->where('status', JobApplicationStatus::INTERVIEWING->value)
            ->orderBy('created_at', 'desc')->get()->map(function ($item) {
                $item['company'] = $item->job->company;
                return $item;
            });
        return $jobApplications;
    }
}
