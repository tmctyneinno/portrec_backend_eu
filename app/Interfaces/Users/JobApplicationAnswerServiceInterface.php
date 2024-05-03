<?php

namespace App\Interfaces\Users;

use App\Dtos\JobApplicationDto;

interface JobApplicationAnswerServiceInterface
{
    public function saveAnswers(string $jobApplicationId, JobApplicationDto $jobApplicationData): bool;
}
