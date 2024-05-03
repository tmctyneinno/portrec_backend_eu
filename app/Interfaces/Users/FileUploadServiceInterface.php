<?php

namespace App\Interfaces\Users;

use Illuminate\Http\UploadedFile;

interface FileUploadServiceInterface
{
    public function upload(UploadedFile $file, string $rootDirectory, ?string $fileName = null): array;

    public function delete(string $filePath): bool;
}
