<?php

namespace App\Interfaces;

use App\Dtos\JobApplicationDto;

interface JobApplicationAnswerServiceInterface
{
    public function saveAnswers(string $jobApplicationId, JobApplicationDto $jobApplicationData): bool;
}
