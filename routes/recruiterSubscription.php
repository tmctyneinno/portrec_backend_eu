<?php

use App\Http\Controllers\Recruiters\SubscriptionController;
use Illuminate\Support\Facades\Route;


Route::controller(SubscriptionController::class)->group(function() {
// Route::get('get/subscriptions', 'getSubscription');

Route::middleware(['auth:sanctum'])->group(function() {
    Route::get('get/recruiter/subscription', 'getRecruiterSubscription');
    Route::post('recruiter/initiate/subscription/payment', 'InitiatePayment');
});
});