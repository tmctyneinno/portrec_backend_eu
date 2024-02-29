<?php

namespace App\Services;

use App\Interfaces\FileUploadServiceInterface;
use Illuminate\Http\UploadedFile;

class CloudinaryFileUploadService implements FileUploadServiceInterface
{
    public function upload(UploadedFile $file, string $rootDirectory, string $fileName = null): array
    {
        $fileName = $fileName ?? null;

        $uploadedFile = cloudinary()->upload($file->getRealPath(), [
            'folder' => '/' . $rootDirectory,
            'display_name' => $fileName
        ]);

        $filePath = $uploadedFile->getSecurePath();
        $publicId = $uploadedFile->getPublicId();
        $fileName = $uploadedFile->getOriginalFileName();

        return [$fileName, $filePath, $publicId];
    }

    public function delete(string $publicId): bool
    {
        if (cloudinary()->destroy($publicId)) {
            return true;
        }
        return false;
    }
}
