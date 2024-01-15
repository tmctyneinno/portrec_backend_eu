<?php

namespace App\Providers;

use App\Interfaces\CoverLetterServiceInterface;
use App\Interfaces\FileUploadServiceInterface;
use App\Interfaces\JobApplicationAnswerServiceInterface;
use App\Interfaces\JobApplicationServiceInterface;
use App\Interfaces\UserServiceInterface;
use App\Services\CloudinaryFileUploadService;
use App\Services\CoverLetterService;
use App\Services\JobApplicationAnswerService;
use App\Services\JobApplicationService;
use App\Services\UserService;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
