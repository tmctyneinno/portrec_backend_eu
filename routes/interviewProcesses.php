<?php

use App\Http\Controllers\Recruiters\ScheduleInterview;
use Illuminate\Support\Facades\Route;


Route::controller(ScheduleInterview::class)->group(function () { 
Route::post('/generate/zoom/token', 'generateInterviewToken');
Route::post('/create/meeting', 'GenerateMeetingLink');
Route::get('get/recruiter/interviews',  'getAllInterviews');
Route::post('user/accept/interview',  'AcceptInterview');
});
