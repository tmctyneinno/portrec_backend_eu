<?php

use App\Http\Controllers\Auth\RecruiterAuthController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\Skill\SkillController;
use App\Http\Controllers\User\CoverLetterController;
use App\Http\Controllers\User\EducationController;
use App\Http\Controllers\User\ResumeController;
use App\Http\Controllers\User\WorkExperienceController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix("user")->group(function () {
    Route::post("signup", [UserAuthController::class, "signup"]);
    Route::post("login", [UserAuthController::class, "signin"]);
    Route::middleware(["auth:sanctum", "login",])->group(function () {
        Route::get("profile", [UserProfileController::class, "myProfile"]);
        Route::put("profile", [UserProfileController::class, "updateProfile"]);
        Route::post("profile/picture", [UserProfileController::class, "uploadProfileImage"]);
        Route::post("profile/picture/{id}", [UserProfileController::class, "uploadProfileImage"]);

        Route::post("skill", [SkillController::class, "skill"]);
        Route::put("skill/{id}", [SkillController::class, "updateSkill"]);
        Route::get("skill", [SkillController::class, "getSkills"]);

        Route::post("education", [EducationController::class, "education"]);
        Route::put("education/{id}", [EducationController::class, "updateEducation"]);
        Route::delete("education/{id}", [EducationController::class, "deleteEducation"]);

        Route::post("resume", [ResumeController::class, "uploadResume"]);
        Route::delete("resume/{id}", [ResumeController::class, "uploadResume"]);

        Route::post("cover-letter", [CoverLetterController::class, "writeCoverLetter"]);
        Route::post("cover-letter/upload", [CoverLetterController::class, "uploadCoverLetter"]);
        Route::put("cover-letter/{id}", [CoverLetterController::class, "updateCoverLetter"]);
        Route::delete("cover-letter/{id}", [CoverLetterController::class, "deleteCoverLetter"]);

        Route::post("experience", [WorkExperienceController::class, "workExperience"]);
        Route::put("experience/{id}", [WorkExperienceController::class, "updateExperience"]);
        Route::delete("experience/{id}", [WorkExperienceController::class, "deleteExperience"]);
    });
});

Route::get("skills", [SkillController::class, "getSkill"]);
