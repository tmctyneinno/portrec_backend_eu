<?php

namespace App\Interfaces\Users;

use App\Dtos\CoverLetterUploadDto;
use App\Models\CoverLetter;

interface CoverLetterServiceInterface
{
    public function saveCoverLetter(CoverLetterUploadDto $coverLetterData): ?CoverLetter;
}
