<?php

namespace App\Services;

use App\Interfaces\UserServiceInterface;
use App\Models\UserProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Smalot\PdfParser\Parser;
use Spatie\LaravelPdf\Facades\Pdf;

class CvBuilderService
{
    public function __construct(
        public readonly UserServiceInterface $userService,
        public readonly Parser $pdfParser
    ) {
    }

    public function buildCvFromProfile()
    {
        $user = auth()->user();

        $profile = $user->profile;

        $nameTitle = Str::slug($user->name);

        $pdf = Pdf::view('pdf-templates.profile', [
            'user' => $user,
            'profile' => $profile,
        ])
            ->format('a4');

        return $pdf;
    }

    public function buildProfileFromCv(?array $file = null)
    {
        $user = auth()->user();

        $resume = $user->default_resume;

        if ($file) {
            [$fileName, $filePath, $publicId] = $file;

            $resume = $this->userService->saveResume($filePath, $fileName, auth()->user(), $publicId);
        }

        $parsePdf = $this->pdfParser->parseContent(file_get_contents($resume->resume_url));

        $text = $parsePdf->getText();

        $skillsStart = strpos($text, 'SKILLS');
        $experienceStart = strpos($text, 'EXPERIENCE');
        $educationStart = strpos($text, 'EDUCATION');

        // if ($skillsStart !== false && $experienceStart !== false && $educationStart !== false) {
        $this->getSkills($text);
        $this->getExperience($text);
        $this->getEducation($text);
        // }
    }

    private function getSkills($text)
    {
        $skillsStart = strpos($text, 'SKILLS');
        $experienceStart = strpos($text, 'EXPERIENCE');

        $cleanedSkills = [];
        $skillsSection = substr($text, $skillsStart, $experienceStart - $skillsStart);

        $skillsArray = preg_split('/\\t*\\n/', $skillsSection);

        $skillsArray = array_filter($skillsArray, function ($line) {
            return stripos($line, 'SKILLS') === false;
        });

        $cleanedSkills = array_merge($cleanedSkills, array_map('trim', array_filter($skillsArray)));

        $individualSkills = [];
        foreach ($cleanedSkills as $line) {
            $individualSkills[] = $line;
        }

        UserProfile::query()
            ->where('user_id', auth()->id())
            ->update([
                'skills' => json_encode($individualSkills),
            ]);
    }

    private function getExperience($text)
    {
        $experienceStart = strpos($text, 'EXPERIENCE');

        $pattern = '/([A-Za-z\s]+)\s+(.*?)\s+((?:\w{3,4}\.\s+\d{4}|(?:Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)\s+\d{4})\s*–\s*(?:\w{3,4}\.\s+\d{4}|(?:Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)\s+\d{4}|Present))\s+(.*?)\s+(?:Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)\.?\s+\d{4}\s*–\s*(?:\w{3,4}\.\s+\d{4}|(?:Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)\s+\d{4}|Present)\s*(.*?)\s*/s';


        preg_match_all($pattern, $text, $matches, PREG_SET_ORDER);

        // Iterate through matches and extract relevant information
        $workExperiences = [];
        foreach ($matches as $match) {
            $position = $match[1];
            $company = $match[2];
            $duration = $match[3];
            $responsibilities = $match[4];
            $start_date = $match[5];
            $end_date = $match[6] ?? null;
            $details = $match[7] ?? null;

            // Create an array with extracted information
            $workExperiences[] = [
                'user_id' => auth()->id(),
                'job_title' => $position,
                'company_name' => $company,
                // 'duration' => $duration,
                'job_level' => $responsibilities,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'description' => $details,
            ];

            // DB::table('work_experiences')
            //     ->insert([
            //         ...$workExperiences
            //     ]);
        }
    }

    private function getEducation($text)
    {
        $educationStart = strpos($text, 'EDUCATION');

        $pattern = '/EDUCATION\s+([A-Za-z\s]+)\s+([A-Za-z\s]+)\s*–\s*(\d{4})\s*-\s*(\d{4})/';

        // Perform the regular expression match
        preg_match_all($pattern, $text, $matches, PREG_SET_ORDER);

        // Extract relevant information
        $educations = [];
        foreach ($matches as $match) {
            $institution = $match[1];
            $degree = $match[2];
            $start_year = $match[3];
            $end_year = $match[4];

            // Create an array with extracted information for each education entry
            $education = [
                'user_id' => auth()->id(),
                'institution' => $institution,
                'qualification_id' => $degree,
                'start_year' => $start_year,
                'end_year' => $end_year
            ];

            // Add the education entry to the array of educations
            $educations[] = $education;
        }

        DB::table('education')
            ->insert([
                ...$educations,
            ]);
    }
}
