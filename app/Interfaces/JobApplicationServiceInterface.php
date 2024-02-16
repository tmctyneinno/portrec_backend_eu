<?php

namespace App\Interfaces;

use App\Dtos\JobApplicationDto;
use App\Models\JobApplication;

interface JobApplicationServiceInterface
{
    public function saveJobApplication(JobApplicationDto $applicationData): ?JobApplication;
    public function saveCoverLetter(string $JobApplicationId, string $coverLetter);
    public function findJobApplication(string $JobApplicationId): ?JobApplication;
}


