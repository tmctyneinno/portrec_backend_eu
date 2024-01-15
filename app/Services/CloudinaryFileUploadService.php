<?php

namespace App\Services;

use App\Interfaces\FileUploadServiceInterface;
use Illuminate\Http\UploadedFile;

class CloudinaryFileUploadService implements FileUploadServiceInterface
{
    public function upload(UploadedFile $file, string $rootDirectory, string $fileName = null): array
    {
        $fileName = $fileName ?? $file->getClientOriginalName();

        $uploadedFile = cloudinary()->upload($file->getRealPath(), [
            'folder' => 'portrec/assets/' . $rootDirectory,
            'filename' => $fileName
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
