<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RecruiterAuthController;


Route::post("signup", [RecruiterAuthController::class, "signup"]);
Route::post("login", [RecruiterAuthController::class, "signin"]);
// Route::get("profile", function () {
// 	return "hello";
// })->middleware(["auth:recruiter", "recruiter.auth"]);