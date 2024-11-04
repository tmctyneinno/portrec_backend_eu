<?php

namespace App\Interfaces\Users;

use App\Dtos\JobApplicationDto;
use App\Models\JobApplication;

interface JobApplicationServiceInterface
{
    public function saveJobApplication(JobApplicationDto $applicationData, $request);
    public function jobApplications($request);
    public function saveCoverLetter(string $JobApplicationId, string $coverLetter);
    public function findJobApplication(string $JobApplicationId): ?JobApplication;
}
