<?php

namespace App\Http\Controllers\Users\Job;

use App\Dtos\CoverLetterUploadDto;
use App\Dtos\JobApplicationAnswerDto;
use App\Dtos\JobApplicationDto;
use App\Enums\JobApplicationStatus;
use App\Http\Controllers\Base\BaseController;
use App\Http\Controllers\Users\Trait\UserTrait;
use App\Http\Requests\CoverLetterRequest;
use App\Http\Requests\JobApplicationAnswerRequest;
use App\Http\Requests\JobApplicationRequest;
use App\Models\User;
use App\Http\Resources\JobApplicationResource;
use App\Interfaces\Users\CoverLetterServiceInterface;
use App\Interfaces\Users\JobApplicationAnswerServiceInterface;
use App\Interfaces\Users\JobApplicationServiceInterface;
use App\Models\Company;
use App\Models\JobApplication;
use App\Models\JobOpening;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JobApplicationController extends BaseController
{
    use UserTrait;
    public function __construct(
        public readonly JobApplicationServiceInterface $jobApplicationService,
        public readonly CoverLetterServiceInterface $coverLetterService,
        public readonly JobApplicationAnswerServiceInterface $jobApplicationAnswerService,
    ) {}

    public function apply(JobApplicationRequest $request)
    {
        try {
            $jobApplicationData = JobApplicationDto::fromRequest($request->validated());
            $jobApplication = $this->jobApplicationService->saveJobApplication($jobApplicationData, $request);
        } catch (\Exception $e) {
            return $this->errorMessage($e->getMessage(), Response::HTTP_SERVICE_UNAVAILABLE);
        }

        return $this->successMessage(new JobApplicationResource($jobApplication->load([
            'user',
            'answers'
        ])));
    }

    public function uploadCoverLetter(CoverLetterRequest $request)
    {
        $coverLetterdata = CoverLetterUploadDto::fromRequest($request->validated());
        $coverLetter = $this->coverLetterService->saveCoverLetter($coverLetterdata);

        if (!$coverLetter) {
            return $this->errorMessage('We ran into an error while trying to handle your request, please try again', Response::HTTP_SERVICE_UNAVAILABLE);
        }

        $jobApplication = $this->jobApplicationService->findJobApplication($coverLetterdata->job_application_id);
        return $this->successMessage(new JobApplicationResource($jobApplication->load(['user'])), 'Job application successfully sent');
    }

    public function guestApply(JobApplicationRequest $request)
    {
        return $this->apply($request);
    }

    public function guestUploadCoverLetter(CoverLetterRequest $request)
    {
        return $this->uploadCoverLetter($request);
    }

    public function guestUploadJobApplicationAnswers(JobApplicationAnswerRequest $request)
    {
        return $this->uploadJobApplicationAnswers($request);
    }

    public function myApplications(Request $request)
    {
        $data = $this->jobApplicationService->jobApplications($request);
        return response()->json($data, 200);
    }
}
