<?php

namespace App\Interfaces;

use App\Dtos\JobApplicationAnswerDto;
use App\Models\JobApplicationAnswer;

interface JobApplicationAnswerServiceInterface
{
    public function saveAnswers(JobApplicationAnswerDto $jobApplicationAnswerDto): bool;
}
