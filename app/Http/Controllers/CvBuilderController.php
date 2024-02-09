<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\BaseController;
use App\Interfaces\FileUploadServiceInterface;
use App\Services\CvBuilderService;
use Illuminate\Http\Request;

class CvBuilderController extends BaseController
{
    public function __construct(
        public readonly CvBuilderService $cvBuilderService,
        public readonly FileUploadServiceInterface $fileUploadService,
    ) {
    }

    public function fromProfile(Request $request)
    {
        $pdf = $this->cvBuilderService->buildCvFromProfile();
        return $pdf->download(auth()->user()->name . '.pdf');
    }

    public function fromCv(Request $request)
    {
        $file = null;

        if ($request->hasFile('resume')) {
            $file = $this->fileUploadService->upload($request->file('resume'), 'resumes');
        }

        $this->cvBuilderService->buildProfileFromCv($file);

        return;
    }
}
