<?php

namespace App\Providers;

use App\Interfaces\DashboardServiceInterface;
use App\Interfaces\Recruiter\InterviewInterface;
use App\Interfaces\Recruiter\PasswordInterface as RecruiterPasswordInterface;
use App\Interfaces\Recruiter\PaymentInterface as RecruiterPaymentInterface;
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
use App\Interfaces\Users\InterviewInterface as UserInterviewInterface;
use App\Interfaces\Users\PasswordInterface;
use App\Interfaces\Users\PaymentInterface;
use App\Services\Recruiter\PasswordServices as RecruiterPasswordServices;
use App\Services\Recruiter\PaymentService as RecruiterPaymentService;
use App\Services\Users\InterviewServices as UserInterviewServices;
use App\Services\Users\PasswordServices;
use App\Services\Users\PaymentService;
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
        app()->bind(UserInterviewInterface::class, UserInterviewServices::class);
        app()->bind(PaymentInterface::class, PaymentService::class);
        app()->bind(RecruiterPaymentInterface::class, RecruiterPaymentService::class);
        app()->bind(PasswordInterface::class, PasswordServices::class);
        app()->bind(RecruiterPasswordInterface::class, RecruiterPasswordServices::class);
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
