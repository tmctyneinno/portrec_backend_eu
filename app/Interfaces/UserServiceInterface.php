<?php

namespace App\Interfaces;

use App\Dtos\UserRegistrationDto;
use App\Models\User;
use App\Models\UserResume;
use Illuminate\Http\UploadedFile;

interface UserServiceInterface
{
    public function saveUser(UserRegistrationDto $userdata): ?array;

    public function saveResume(string $uploadPath, ?string $name = null, ?User $user = null): ?UserResume;
}
