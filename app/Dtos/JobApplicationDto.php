<?php

namespace App\Dtos;

use Illuminate\Http\UploadedFile;

class JobApplicationDto extends BaseDto

{
    public function __construct(
        public readonly string|int $job_id,
        public UploadedFile|string $resume,
        public readonly ?string $name,
        public readonly ?string $email,
        public readonly ?string $phone_number,
        public ?string $user_id = null,
    ) {
    }

    public static function fromRequest(array $data)
    {
        return new static(
            $data['job_id'],
            $data['resume'],
            $data['name'] ?? null,
            $data['email'] ?? null,
            $data['phone_number'] ?? null,
            auth()->user()->id ?? null,
        );
    }
}
