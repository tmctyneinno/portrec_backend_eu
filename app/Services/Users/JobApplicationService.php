<?php

namespace App\Services\Users;

use App\Dtos\JobApplicationDto;
use App\Dtos\UserRegistrationDto;
use App\Enums\JobApplicationStatus;
use App\Helper\FileUpload;
use App\Interfaces\Users\FileUploadServiceInterface;
use App\Interfaces\Users\JobApplicationAnswerServiceInterface;
use App\Interfaces\Users\JobApplicationServiceInterface;
use App\Interfaces\Users\UserServiceInterface;
use App\Models\CoverLetter;
use App\Models\User;
use App\Models\JobApplication;
use App\Models\JobOpening;
use App\Notifications\GuestUserRegistrationNotification;
use App\Notifications\JobApplicationSentNotification;
use Carbon\Carbon;
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
    ) {}

    public function saveJobApplication(JobApplicationDto $applicationData, $request)
    {

        $uploadFolder = 'resumes';
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

                // Saving Resume to Local
                if ($applicationData->resume instanceof UploadedFile) {
                    $fileUploaded = FileUpload::uploadFileToPath($request, 'resume',  $uploadFolder);
                    // [$fileName, $filePath, $publicId] = $this->fileUploadService->upload($applicationData->resume, 'resumes/' . $user->id);
                    $resume = $this->userService->saveResume($fileUploaded['url'], $fileUploaded['name'], $user, null);
                    $applicationData->resume = $resume->id;
                }

                try {
                    $user->notify((new GuestUserRegistrationNotification($user, $plainTextPassword))
                        ->afterCommit());
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }

            // Saving Resume to Local
            if ($applicationData->resume instanceof UploadedFile) {
                $user = auth()->user();
                $fileUploaded = FileUpload::uploadFileToPath($request, 'resume',  $uploadFolder);
                // [$fileName, $filePath, $publicId] = $this->fileUploadService->upload($applicationData->resume, 'resumes/' . $user->id);
                $resume = $this->userService->saveResume($fileUploaded['url'], $fileUploaded['name'], $user, null);
                $applicationData->resume = $resume->id;
            }

            CoverLetter::query()
                ->create([
                    'user_id' => $applicationData->user_id ?? auth()->user()->id,
                    'content' => $applicationData->cover_letter,
                ]);

            $JobApplication = JobApplication::query()
                ->create([
                    'user_id' => $applicationData->user_id ?? auth()->user()->id,
                    'job_opening_id' => $applicationData->job_id,
                    'resume_id' => $applicationData->resume,
                    'status' => JobApplicationStatus::IN_REVIEW->name,
                    'is_viewed' => 0,
                    'applied_date' => Carbon::now(),
                    'cover_letter' => $applicationData->cover_letter,
                    'portfolio_links' => $applicationData->portfolio_link
                ]);


            if ($applicationData->answers) {
                $this->jobApplicationAnswerService->saveAnswers($JobApplication->id, $applicationData);
            }

            // increment total_applied
            JobOpening::where('id', $applicationData->job_id)->increment('total_applied');


            // send email to logged-in user
            try {
                $user = User::find($applicationData->user_id);
                $job = JobOpening::find($applicationData->job_id);
                $user->notify(new JobApplicationSentNotification([
                    'job_title' => $job->title,
                    'name' => $user->name,
                    'company' => $job->company->name,
                ]));
                AddUserToTopTalent($user->id);
            } catch (\Throwable $th) {
                // throw $th;   
            }



            DB::commit();
            return $JobApplication;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
            return 'error';
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


    private function queryAndMapApplications($request, $status = null)
    {
        $id = auth()->user()->id;
        $start_date = $request->start_date ? Carbon::parse($request->start_date)->toDateString() : Carbon::now()->toDateString();
        $end_date = $request->end_date ? Carbon::parse($request->end_date)->toDateString() : Carbon::now()->toDateString();

        $query = JobApplication::with(['user', 'job'])
            ->where('user_id', $id)
            ->whereNotNull('status');

        // Apply the status filter only if $status is not null
        if (!is_null($status)) {
            $query->where('status', $status);
        }

        $query = $query
            ->whereBetween('applied_date', [$start_date, $end_date])
            ->get()->map(function ($item) {
                $item['company'] = $item->job->company;
                return $item;
            });

        return $query;
    }


    public function jobApplications($request)
    {
        $data = [
            'ALL' => $this->queryAndMapApplications($request),
            'IN_REVIEW' => $this->queryAndMapApplications($request, JobApplicationStatus::IN_REVIEW->value),
            'SHORTLISTED' => $this->queryAndMapApplications($request, JobApplicationStatus::SHORTLISTED->value),
            'OFFERED' => $this->queryAndMapApplications($request, JobApplicationStatus::OFFERED->value),
            'INTERVIEWING' => $this->queryAndMapApplications($request, JobApplicationStatus::INTERVIEWING->value),
            'REJECTED' => $this->queryAndMapApplications($request, JobApplicationStatus::REJECTED->value),
            'SHORTLISTED' => $this->queryAndMapApplications($request, JobApplicationStatus::SHORTLISTED->value),
        ];
        return $data;
    }
}
