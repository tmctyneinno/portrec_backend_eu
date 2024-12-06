<?php

namespace App\Providers;

use App\Interfaces\DashboardServiceInterface;
use App\Interfaces\Recruiter\InterviewInterface;
use App\Interfaces\Users\CoverLetterServiceInterface;
use App\Interfaces\Users\FileUploadServiceInterface;
use App\Interfaces\Users\JobApplicationAnswerServiceInterface;
use App\Interfaces\Users\JobApplicationServiceInterface;
use App\Interfaces\Users\MessageServiceInterface;
use App\Interfaces\Users\UserServiceInterface;
use App\Services\Recruiter\InterviewServices;
use App\Services\Users\CloudinaryFileUploadService;
use App\Services\Users\CoverLetterService;
use App\Services\Users\DashboardService;
use App\Services\Users\JobApplicationAnswerService;
use App\Services\Users\JobApplicationService;
use App\Services\Users\MessageService;
use App\Services\Users\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        app()->bind(FileUploadServiceInterface::class, CloudinaryFileUploadService::class);
        app()->bind(UserServiceInterface::class, UserService::class);
        app()->bind(JobApplicationServiceInterface::class, JobApplicationService::class);
        app()->bind(CoverLetterServiceInterface::class, CoverLetterService::class);
        app()->bind(JobApplicationAnswerServiceInterface::class, JobApplicationAnswerService::class);
        app()->bind(MessageServiceInterface::class, MessageService::class);
        app()->bind(DashboardServiceInterface::class, DashboardService::class);
        app()->bind(InterviewInterface::class, InterviewServices::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
