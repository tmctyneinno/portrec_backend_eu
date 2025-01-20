<?php 
namespace App\routes;

use App\Http\Controllers\Users\PasswordController;
use Illuminate\Support\Facades\Route;


Route::controller(PasswordController::class)->group(function() {
Route::post('user/send/otp', 'verifyOTPEmail');
Route::post('user/verify/otp', 'verifyOTP');
Route::post('user/update/password', 'ResetPassword');
});



