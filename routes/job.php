<?php

use App\Http\Controllers\Job\JobApplicationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;

Route::middleware(['auth:sanctum'])->group(function () {
  Route::post("apply", [JobApplicationController::class, 'apply']);
  Route::post("apply/cover-letter", [JobApplicationController::class, 'uploadCoverLetter']);
  Route::post("apply/answers", [JobApplicationController::class, 'uploadJobApplicationAnswers']);
});

Route::controller(JobApplicationController::class)->group(function () {
  Route::post('apply/guest', 'guestApply');
  Route::post('apply/cover-letter/guest', 'guestUploadCoverLetter');
  Route::post('apply/answers/guest', 'guestUploadJobApplicationAnswers');
});


Route::get("all/{type?}/{id?}", [JobController::class, "showJobs"]);
Route::get("industries/{id?}", [JobController::class, "jobIndustries"]);
Route::get("types/{id?}", [JobController::class, "jobTypes"]);
Route::get("levels/{id?}", [JobController::class, "jobLevels"]);
Route::get("functions/{id?}", [JobController::class, "jobFunctions"]);
Route::get("salary/{from}/{to}", [JobController::class, "jobSalaryRansge"]);
Route::get("search", [JobController::class, "jobSearch"]);
Route::get("/{id}", [JobController::class, "jobDetails"]);
