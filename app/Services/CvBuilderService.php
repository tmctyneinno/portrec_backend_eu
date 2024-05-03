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

            // $resume = $this->userService->saveResume($filePath, $fileName, auth()->user(), $publicId);
        }

        $parsePdf = $this->pdfParser->parseContent(file_get_contents($filePath));

        $text = $parsePdf->getText();
        // dd( $text );
        $lines = explode("\n", $text);

        $jobExperience = '';
        $educationQualifications = '';
        $Skills = '';
        $inJobExperience = false;
        $inEducationQualifications = false;
        $inSkills = false;
        foreach ($lines as $line) {
            // Check for keywords indicating start of job experience section
            if (stripos($line, 'EXPERIENCE') !== false) {
                $inJobExperience = true;
                $inEducationQualifications = false; // Ensure we're not in the education section
                continue; // Skip to the next line
            }
            if (stripos($line, 'SKILLS') !== false) {
                $inSkills = true;
                $inJobExperience = false; // Ensure we're not in the job experience section
                $inEducationQualifications = false;
                continue; // Skip to the next line
            }
            if (stripos($line, 'EDUCATION') !== false) {
                $inEducationQualifications = true;
                $inJobExperience = false; // Ensure we're not in the job experience section
                continue; // Skip to the next line
            }

            if ($inJobExperience) {
                $jobExperience .= $line . "\n";
            } elseif ($inEducationQualifications) {
                $educationQualifications .= $line . "\n";
            }elseif($inSkills){
                $Skills .=$line . "\n";
            }
        }  
      $data['jobExperience'] =  json_encode($this->postProcessText($this->processCV($jobExperience)));
      $data['educationQualifications'] =  json_encode($this->postProcessText($this->processCV($educationQualifications)));
      $data['Skills'] =  json_encode($this->postProcessText($this->processCV($Skills)));
      dd($data);
        // dd($Skills);
   
        // return [
        //     'contact_info' => $this->extractContactInfo($text) ?? null,
        //     'experience' => trim($jobExperience),
        //     'education' => trim($educationQualifications),
        //     'Skills' => trim($Skills),
        // ];
    }
    protected function postProcessText($text)
    {
        $text = preg_replace('/\s+/', ' ', $text);
        $text = preg_replace('/\.([A-Za-z])/', '. $1', $text);
        $text = preg_replace('/([a-z])([A-Z])/', '$1 $2', $text);
        $text = str_replace(['–', '.'], '', $text);
        return $text;
    }

    public function processCV($data){
        $mergedArray = [];
        $cleanedArray = [];
        $SplitArray = preg_split('/\\t*\\n/', $data);
        $array = array_merge($mergedArray, array_map('trim', array_filter($SplitArray)));

        foreach($array as $line) {
            $cleanedArray[] =  preg_replace('/([a-z])([A-Z])/', '$1 $2', $line);
        }
      return $cleanedArray;
    }

    // private function extractContactInfo($text)
    // {
    //     $contactInfo = [];

    //     if (preg_match('/\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,}\b/', $text, $matches)) {
    //         $contactInfo['email'] = $matches[0];
    //     }
    //     if (preg_match('/https?:\/\/\S+/', $text, $matches)) {
    //         $contactInfo['website'] = $matches[0];
    //     }
    //     if (preg_match('/https?:\/\/github\.com\/\S+/', $text, $matches)) {
    //         $contactInfo['github'] = $matches[0];
    //     }
    //     if (preg_match('/https?:\/\/linkedin\.com\/\S+/', $text, $matches)) {
    //         $contactInfo['linkedin'] = $matches[0];
    //     }

    //     if (preg_match('/\+?[0-9]{10,}/', $text, $matches)) {
    //         $contactInfo['phone'] = $matches[0];
    //     }

    //     return $contactInfo;
    // }
    // private function getExperience($text)
    // {

    //     $experienceStart = strpos($text, 'EXPERIENCE');
    //     $experienceEnd = strpos($text, 'SKILLS');

    //     $experienceSection = substr($text, $experienceStart, $experienceEnd );


    //     $experienceArray = preg_split('/\\t*\\n/', $experienceSection);


    //     $cleanedExperience = [];
    //     $experienceArray = array_filter($experienceArray, function ($line) {
    //         return strpos($line, 'EXPERIENCE') == false;
    //     });

    //     $cleanedExperience = array_merge($cleanedExperience, array_map('trim', array_filter($experienceArray)));

    //     $individualExperiences = [];
    //     foreach ($cleanedExperience as $line) {
    //         $individualExperiences[] = $line;
    //     }

    //     return $individualExperiences;
    // }

    // private function extractSkills($text)
    // {
    //     $skillsStart = strpos($text, 'SKILLS');

    //     $skillsSection = substr($text, $skillsStart);

    //     $lines = preg_split('/\r?\n/', $skillsSection);

    //     $cleanedSkills = array_filter($lines, function ($line) {
    //         return stripos($line, 'SKILLS') === false;
    //     });
       

    //     $individualSkills = array_map('trim', $cleanedSkills);

    //     return $individualSkills;
    // }


   

  



    // private function extractEducation($text)
    // {
    //     $educationStart = strpos($text, 'EDUCATION');
    //     $educationSection = substr($text, $educationStart);
    //     $educationArray = preg_split('/\\t*\\n/', $educationSection);

       
    //     $cleanedEducation = [];
    //     $educationArray = array_filter($educationArray, function ($line) {
    //         return stripos($line, 'EDUCATION') === false;
    //     });
    //     // dd($educationArray);
    //     $cleanedEducation = array_merge($cleanedEducation, array_map('trim', array_filter($educationArray)));

    //     foreach ($educationArray as $line) {
    //         if (strpos($line, '•') === false) {
    //             break;
    //         }

    //         $cleanedEducation[] = $line;
    //     }

    //     $individualEducations = [];
    //     foreach ($cleanedEducation as $line) {
    //         $individualEducations[] = $line;
    //     }

    //     return $cleanedEducation;
    // }
}
