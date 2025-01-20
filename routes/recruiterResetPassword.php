<?php

use App\Http\Controllers\Recruiters\PasswordController;
use Illuminate\Support\Facades\Route;

Route::controller(PasswordController::class)->group(function() {
    Route::post('recruiter/send/otp', 'sendOTPEmail');
    Route::post('recruiter/verify/otp', 'verifyOTP');
    Route::post('recruiter/reset/password', 'ResetPassword');  

});