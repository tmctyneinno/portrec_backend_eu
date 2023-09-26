<?php

use App\Http\Controllers\Auth\RecruiterAuthController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\JobController;
use Illuminate\Http\Request;
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
    Route::post("sigin", [UserAuthController::class, "signin"]);
});

Route::prefix("recruiter")->group(function () {
    Route::post("signup", [RecruiterAuthController::class, "signup"]);
    Route::post("sigin", [RecruiterAuthController::class, "sigin"]);
});

Route::prefix("job")->group(function () {
    Route::get("all", [JobController::class, "showJobs"]);
    Route::get("categories", [JobController::class, "jobCategories"]);
    Route::get("types", [JobController::class, "jobTypes"]);
    Route::get("functions/{id?}", [JobController::class, "jobFunctions"]);
    Route::get("/{id}", [JobController::class, "jobDetails"]);
});
