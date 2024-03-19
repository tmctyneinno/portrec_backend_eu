<?php

namespace App\Services;

use App\Dtos\JobApplicationDto;
use App\Dtos\UserRegistrationDto;
use App\Enums\JobApplicationStatus;
use App\Interfaces\FileUploadServiceInterface;
use App\Interfaces\JobApplicationAnswerServiceInterface;
use App\Interfaces\JobApplicationServiceInterface;
use App\Interfaces\UserServiceInterface;
use App\Models\CoverLetter;
use App\Models\User;
use App\Models\JobApplication;
use App\Notifications\GuestUserRegistrationNotification;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class JobApplicationService implements JobApplicationServiceInterface
{
    public function __construct(
        public readonly UserServiceInterface $userService,
        public readonly FileUploadServiceInterface $fileUploadService,
        public readonly JobApplicationAnswerServiceInterface $jobApplicationAnswerService,
    ) {
    }

    public function saveJobApplication(JobApplicationDto $applicationData)
    {

        try {
            DB::beginTransaction();

            if (!auth()->user()) {
                $userData = UserRegistrationDto::fromRequest([
                    'name' => $applicationData->name,
                    'email' => $applicationData->email,
                    'phone_number' => $applicationData->phone_number
                ]);

                [$user, $plainTextPassword] = $this->userService->saveUser($userData);
                 Auth::loginUsingId($user->id);
                if ($applicationData->resume instanceof UploadedFile) {

                    [$fileName, $filePath, $publicId] = $this->fileUploadService->upload($applicationData->resume, 'resumes/' . $user->id);

                    $resume = $this->userService->saveResume($filePath, $fileName, $user, $publicId);
                    dd($resume);
                   
                    $applicationData->resume = $resume->id;
                }
               $user->notify((new GuestUserRegistrationNotification($user, $plainTextPassword))->afterCommit());
                $applicationData->user_id = $user->id;
            }
           
            if ($applicationData->resume instanceof UploadedFile) {
                $user = auth()->user();

                [$fileName, $filePath, $publicId] = $this->fileUploadService->upload($applicationData->resume, 'resumes/' . $user->id);

                $resume = $this->userService->saveResume($filePath, $fileName, $user, $publicId);


                $applicationData->resume = $resume->id;
                $applicationData->user_id = $user->id;
            }

            CoverLetter::query()
                ->create([
                    'user_id' => $applicationData->user_id ?? auth()->user()->id,
                    'content' => $applicationData->cover_letter,
                ]);

            $JobApplication = JobApplication::query()
                ->create([
                    'user_id' => $applicationData->user_id,
                    'job_opening_id' => $applicationData->job_id,
                    'resume_id' => $applicationData->resume,
                    'status' => JobApplicationStatus::IN_REVIEW->name,
                    'is_viewed' => 0,
                    'applied_date' => now(),
                'cover_letter' => $applicationData->cover_letter,
                'portfolio_links' => $applicationData->portfolio_link
                ]);

              
            $this->jobApplicationAnswerService->saveAnswers($JobApplication->id, $applicationData);

            DB::commit();
            return $JobApplication;
        } catch (Throwable $e) {
            DB::rollBack();
            return $e;
        }
    }

    public function saveCoverLetter(string $JobApplicationId, string $coverLetter)
    {
        return JobApplication::query()
            ->where('id', $JobApplicationId)
            ->update([
                'cover_letter' => $coverLetter
            ]);
    }

    public function findJobApplication(string $JobApplicationId): ?JobApplication
    {
        try {
            $JobApplication = JobApplication::query()
                ->where('id', $JobApplicationId)
                ->firstOrFail();

            return $JobApplication;
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }
}
