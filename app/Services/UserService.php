<?php

namespace App\Services;

use App\Dtos\UserRegistrationDto;
use App\Interfaces\UserServiceInterface;
use App\Models\User;
use App\Models\UserResume;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserService implements UserServiceInterface
{
    public function saveUser(UserRegistrationDto $userData): ?array
    {
        $plainTextPassword = $userData->password ?? Str::random(8);

        $user = User::query()
            ->create([
                'name' => $userData->name,
                'email' => $userData->email,
                'password' => Hash::make($plainTextPassword),
                'phone' => $userData->phone_number,
            ]);

        return [$user, $plainTextPassword] ?? null;
    }

    public function saveResume(string $uploadPath, ?string $name = null, ?User $user = null, string $publicId = null): ?UserResume
    {
        $user = $user ?? auth()->user();
        return UserResume::query()
            ->create([
                'user_id' => $user->id,
                'resume_url' => $uploadPath,
                'resume_name' => $name ?? $user->name . "'s CV",
            'public_id' => $publicId ?? null,
            ]);
    }
}
