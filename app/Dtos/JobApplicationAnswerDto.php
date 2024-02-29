<?php

namespace App\Dtos;

class JobApplicationAnswerDto extends BaseDto
{
    public function __construct(
        public readonly string $job_application_id,
        public readonly array $answers,
        public readonly ?string $user_id = null,
    ) {
    }
}


