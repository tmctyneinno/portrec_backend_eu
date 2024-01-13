<?php

namespace App\Services;

use App\Interfaces\FileUploadServiceInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileUploadService implements FileUploadServiceInterface
{
    public function upload(UploadedFile $file, string $rootDirectory, string $fileName = null): array
    {
        $fileName = $fileName ?? $file->getClientOriginalName();

        $filePath = $fileName ? Storage::putFileAs($rootDirectory, $file, $fileName, 'public')  : Storage::putFile($rootDirectory, $file, 'public');

        return [$fileName, $filePath];
    }

    public function delete(string $filePath): bool
    {
        if (Storage::delete($filePath)) {
            return true;
        }

        return false;
    }
}
