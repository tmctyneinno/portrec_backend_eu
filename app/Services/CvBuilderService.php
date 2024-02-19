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

        // Define regular expressions for each section
        // $contactRegex = '/CONTACT\s*(.*?)\s*EDUCATION/s';
        $contactRegex = '/CONTACT\s*(.*?)\s*(?=EXPERIENCE|EDUCATION)/si';
        $educationRegex = '/EDUCATION\s*(.*?)\s*(?=EXPERIENCE)/si';
        $experienceRegex = '/EXPERIENCE\s*(.*)/';
        $skillsRegex = '/SKILLS\s*(.*?)\s*(?=)/si';

        preg_match($contactRegex, $text, $contactMatches);
        preg_match($educationRegex, $text, $educationMatches);
        preg_match($experienceRegex, $text, $experienceMatches);
        preg_match($skillsRegex, json_encode($text), $skillsMatches);

        return [
            'contact_info' => $this->extractContactInfo($text) ?? null,
            'education' => $this->extractEducation($text),
            'experience' => $this->getExperience($text),
            'skills' => $this->extractSkills($text),
        ];
    }

    private function extractSkills($text)
    {
        $skillsStart = strpos($text, 'SKILLS');

        $skillsSection = substr($text, $skillsStart);

        $lines = preg_split('/\r?\n/', $skillsSection);

        $cleanedSkills = array_filter($lines, function ($line) {
            return stripos($line, 'SKILLS') === false;
        });

        $individualSkills = array_map('trim', $cleanedSkills);

        return $individualSkills;
    }


    private function getExperience($text)
    {
        $experienceStart = strpos($text, 'EXPERIENCE');

        $experienceSection = substr($text, $experienceStart);

        $experienceArray = preg_split('/\\t*\\n/', $experienceSection);

        $cleanedExperience = [];
        $experienceArray = array_filter($experienceArray, function ($line) {
            return stripos($line, 'EXPERIENCE') === false;
        });

        $cleanedExperience = array_merge($cleanedExperience, array_map('trim', array_filter($experienceArray)));

        $individualExperiences = [];
        foreach ($cleanedExperience as $line) {
            $individualExperiences[] = $line;
        }

        return $individualExperiences;
    }

    private function extractContactInfo($text)
    {
        $contactInfo = [];

        // Extract email
        if (preg_match('/\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,}\b/', $text, $matches)) {
            $contactInfo['email'] = $matches[0];
        }

        // Extract website
        if (preg_match('/https?:\/\/\S+/', $text, $matches)) {
            $contactInfo['website'] = $matches[0];
        }

        // Extract GitHub
        if (preg_match('/https?:\/\/github\.com\/\S+/', $text, $matches)) {
            $contactInfo['github'] = $matches[0];
        }

        // Extract LinkedIn
        if (preg_match('/https?:\/\/linkedin\.com\/\S+/', $text, $matches)) {
            $contactInfo['linkedin'] = $matches[0];
        }

        // Extract phone number
        if (preg_match('/\+?[0-9]{10,}/', $text, $matches)) {
            $contactInfo['phone'] = $matches[0];
        }

        // Extract location
        // $location = preg_replace('/(state|\s+)/', '', $text);
        // $contactInfo['location'] = trim($location);

        return $contactInfo;
    }



    private function extractEducation($text)
    {
        $educationStart = strpos($text, 'EDUCATION');

        $educationSection = substr($text, $educationStart);

        $educationArray = preg_split('/\\t*\\n/', $educationSection);

        $cleanedEducation = [];
        $educationArray = array_filter($educationArray, function ($line) {
            return stripos($line, 'EDUCATION') === false;
        });

        $cleanedEducation = array_merge($cleanedEducation, array_map('trim', array_filter($educationArray)));

        foreach ($educationArray as $line) {
            if (strpos($line, '•') === false) {
                break;
            }

            $cleanedEducation[] = $line;
        }

        $individualEducations = [];
        foreach ($cleanedEducation as $line) {
            $individualEducations[] = $line;
        }

        return $cleanedEducation;
    }
}
