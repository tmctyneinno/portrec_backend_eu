<?php

namespace App\Dtos;

class UserRegistrationDto extends BaseDto
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $phone_number,
        public readonly ?string $password = null,
    ) {
    }
}
