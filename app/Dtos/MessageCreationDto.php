<?php

namespace App\Dtos;

use Illuminate\Http\UploadedFile;

class MessageCreationDto extends BaseDto
{
    public function __construct(
        public readonly string $recipient_id,
        public readonly string $message,
        public readonly ?string $conversation_id = null,
        public ?UploadedFile $attachment = null,
    ) {
    }
}
