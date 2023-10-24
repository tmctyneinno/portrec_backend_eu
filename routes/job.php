<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\User\JobApplicationController;


Route::post("apply/{jobId}", [JobApplicationController::class, "applyForJob"])->middleware("auth:sanctum");

Route::get("all/{type?}/{id?}", [JobController::class, "showJobs"]);
Route::get("categories/{id?}", [JobController::class, "jobCategories"]);
Route::get("types/{id?}", [JobController::class, "jobTypes"]);
Route::get("levels/{id?}", [JobController::class, "jobLevels"]);
Route::get("functions/{id?}", [JobController::class, "jobFunctions"]);
Route::get("salary/{from}/{to}", [JobController::class, "jobSalaryRansge"]);
Route::get("search", [JobController::class, "jobSearch"]);
Route::get("/{id}", [JobController::class, "jobDetails"]);
