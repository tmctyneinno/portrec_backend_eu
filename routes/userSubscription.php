<?php

use App\Http\Controllers\Users\SubscriptionController;
use Illuminate\Support\Facades\Route;


Route::controller(SubscriptionController::class)->group(function() {
Route::get('get/subscriptions', 'getSubscription');

Route::middleware(['auth:sanctum'])->group(function() {
    Route::get('get/user/subscription', 'getUserSubscription');
    Route::post('user/initiate/subscription/payment', 'InitiatePayment');
});
});