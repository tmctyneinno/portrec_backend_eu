<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RecruiterAuthController;
use App\Http\Controllers\Recruiters\{
    CvBuilderController,
    FuncsController,
    JobController,
    MessageController,
    SkillController,
    CoverLetterController,
    EducationController,
    JobApplicationController,
    ResumeController,
    WorkExperienceController,
    PortolioController,
    ProfileController,
    UserProfileController,
    CompanyController
};

Route::prefix("recruiter")->group(function () {
    Route::post("signup", [RecruiterAuthController::class, "signup"]);
    Route::post("login", [RecruiterAuthController::class, "signin"]);

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get("profile", [ProfileController::class, "myProfile"]);
        Route::post("password", [ProfileController::class, "updatePassword"]);
        Route::post("profile/update", [ProfileController::class, "updateProfile"]);
    });
});


// Route::get("profile", function () {
// 	return "hello";
// })->middleware(["auth:recruiter", "recruiter.auth"]);
