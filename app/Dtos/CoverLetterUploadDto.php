<?php

namespace App\Dtos;

class CoverLetterUploadDto extends BaseDto
{
    public function __construct(
        public readonly string $job_application_id,
        public readonly string $cover_letter,
        public readonly ?string $portfolio_link,
        public readonly ?string $user_id = null,
    ) {
    }
}
