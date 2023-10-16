<?php

use App\Http\Controllers\Auth\RecruiterAuthController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\Skill\SkillController;
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

        Route::post("skill", [UserProfileController::class, "skill"]);
        Route::put("skill/{id}", [UserProfileController::class, "updateSkill"]);
        Route::get("skill", [UserProfileController::class, "getSkills"]);

        Route::post("education", [UserProfileController::class, "education"]);
        Route::put("education/{id}", [UserProfileController::class, "updateEducation"]);
        Route::delete("education/{id}", [UserProfileController::class, "deleteEducation"]);

        Route::post("resume", [UserProfileController::class, "uploadResume"]);
        Route::delete("resume/{id}", [UserProfileController::class, "uploadResume"]);

        Route::post("cover-letter", [UserProfileController::class, "writeCoverLetter"]);
        Route::post("cover-letter/upload", [UserProfileController::class, "uploadCoverLetter"]);
        Route::put("cover-letter/{id}", [UserProfileController::class, "updateCoverLetter"]);
        Route::delete("cover-letter/{id}", [UserProfileController::class, "deleteCoverLetter"]);

        Route::post("experience", [UserProfileController::class, "workExperience"]);
        Route::put("experience/{id}", [UserProfileController::class, "updateExperience"]);
        Route::delete("experience/{id}", [UserProfileController::class, "deleteExperience"]);
    });
});

Route::get("skills", [SkillController::class, "getSkill"]);
