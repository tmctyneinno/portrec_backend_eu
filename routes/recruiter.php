<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RecruiterAuthController;



Route::prefix("recruiter")->group(function () {
    Route::post("signup", [RecruiterAuthController::class, "signup"]);
    Route::post("login", [RecruiterAuthController::class, "signin"]);
});

Route::middleware(['auth:sanctum'])->group(function () {
});
// Route::get("profile", function () {
// 	return "hello";
// })->middleware(["auth:recruiter", "recruiter.auth"]);
