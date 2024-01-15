<?php

namespace App\Services;

use App\Dtos\AnswerDto;
use App\Dtos\JobApplicationAnswerDto;
use App\Interfaces\JobApplicationAnswerServiceInterface;
use Illuminate\Support\Facades\DB;
use Throwable;

class JobApplicationAnswerService implements JobApplicationAnswerServiceInterface
{
    public function saveAnswers(JobApplicationAnswerDto $jobApplicationAnswerData): bool
    {
        $data = [];

        foreach ($jobApplicationAnswerData->answers as $jobApplicationAnswer) {

            $answerData = AnswerDto::fromRequest([
                'question_id' => $jobApplicationAnswer['question_id'],
                'answer' => $jobApplicationAnswer['answer'],
            ]);

            array_push($data, [
                'user_id' => $jobApplicationAnswerData->user_id ?? auth()->user()->id,
                'job_application_id' => $jobApplicationAnswerData->job_application_id,
                'job_opening_question_id' => $answerData->question_id,
                'answer' => $answerData->answer,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        try {
            DB::beginTransaction();

            $isInserted = DB::table('job_application_answers')
                ->insert([
                    ...$data
                ]);

            DB::commit();

            return $isInserted;
        } catch (Throwable $e) {
            logger($e);
            DB::rollBack();
            return false;
        }
    }
}
