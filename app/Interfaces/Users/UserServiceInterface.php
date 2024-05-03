<?php

namespace App\Interfaces\Users;

use App\Dtos\UserRegistrationDto;
use App\Models\User;
use App\Models\UserResume;
use Illuminate\Http\UploadedFile;

interface UserServiceInterface
{
    public function saveUser(UserRegistrationDto $userdata): ?array;

    public function saveResume(string $uploadPath, ?string $name = null, ?User $user = null, string $publicId = null): ?UserResume;

    public function setDefaultResume(string $resumeId): null|User|bool;

    public function setDefaultCoverLetter(string $coverletterId): null|User|bool;
}
