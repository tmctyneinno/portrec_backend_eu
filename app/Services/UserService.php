<?php

namespace App\Services;

use App\Dtos\UserRegistrationDto;
use App\Interfaces\UserServiceInterface;
use App\Models\CoverLetter;
use App\Models\User;
use App\Models\UserResume;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserService implements UserServiceInterface
{
    public function saveUser(UserRegistrationDto $userData): ?array
    {
        $plainTextPassword = $userData->password ?? $userData->name.Str::random(8);

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

    public function setDefaultResume(string $resumeId): null|User|bool
    {
        // Make sure that the user setting this as default resume is the owner of the resume
        try {
            UserResume::query()
                ->where('id', $resumeId)
                ->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return false;
        }

        $isUpdated = User::query()
            ->where('id', auth()->id())
            ->update([
                'resume_id' => $resumeId
            ]);

        if ($isUpdated) {
            return auth()->user();
        }

        return null;
    }

    public function setDefaultCoverLetter(string $coverletterid): null|User|bool
    {
        // Make sure that the user setting this as default cover letter is the owner of the cover letter
        try {
            CoverLetter::query()
                ->where('id', $coverletterid)
                ->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return false;
        }

        $isUpdated = User::query()
            ->where('id', auth()->id())
            ->update([
                'cover_letter_id' => $coverletterid
            ]);

        if ($isUpdated) {
            return auth()->user();
        }

        return null;
    }
}
