<?php

namespace App\Services\Users;

use App\Dtos\CoverLetterUploadDto;
use App\Interfaces\Users\CoverLetterServiceInterface;
use App\Interfaces\Users\JobApplicationServiceInterface;
use App\Models\CoverLetter;
use Illuminate\Support\Facades\DB;
use Throwable;

class CoverLetterService implements CoverLetterServiceInterface
{
    public function __construct(
        public readonly JobApplicationServiceInterface $jobApplicationService
    ) {
    }

    public function saveCoverLetter(CoverLetterUploadDto $coverLetterData): ?CoverLetter
    {
        try {
            DB::beginTransaction();

            $coverLetter = CoverLetter::query()
                ->create([
                    'user_id' => $coverLetterData->user_id ?? auth()->user()->id,
                    'content' => $coverLetterData->cover_letter,
                ]);

            $this->jobApplicationService->saveCoverLetter($coverLetterData->job_application_id, $coverLetter->content);

            DB::commit();

            return $coverLetter;
        } catch (Throwable $e) {
            logger($e);
            DB::rollBack();
            return null;
        }
    }
}
