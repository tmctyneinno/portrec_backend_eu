<?php

namespace App\Services;

use App\Dtos\AnswerDto;
use App\Dtos\JobApplicationDto;
use App\Interfaces\JobApplicationAnswerServiceInterface;
use Illuminate\Support\Facades\DB;

class JobApplicationAnswerService implements JobApplicationAnswerServiceInterface
{
    public function saveAnswers(string $jobApplicationId, JobApplicationDto $jobApplicationData): bool
    {
        
        $data = [];

        foreach ($jobApplicationData->answers as $jobApplicationAnswer) {

            // dd($jobApplicationData->answers);
            $answerData = AnswerDto::fromRequest([
                'question_id' => $jobApplicationAnswer['question_id'],
                'answer' => $jobApplicationAnswer['answer'],
            ]);

            array_push($data, [
                'user_id' => $jobApplicationData->user_id ?? auth()->user()->id,
                'job_application_id' => $jobApplicationId,
                'job_opening_question_id' => $answerData->question_id,
                'answer' => $answerData->answer,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        $isInserted = DB::table('job_application_answers')
        ->insert([
            ...$data
        ]);

        return $isInserted;
    }
}
