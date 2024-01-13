<?php

namespace App\Dtos;

class AnswerDto extends BaseDto
{
    public function __construct(
        public readonly string $question_id,
        public readonly string $answer,
    ) {
    }
}
