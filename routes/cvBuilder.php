<?php

use App\Http\Controllers\Users\CvBuilderController;
use Illuminate\Support\Facades\Route;



Route::prefix('cv')->group(function () {
    Route::controller(CvBuilderController::class)->group(function() {
        Route::get('/', []);
        Route::post('from-profile', 'fromProfile');
        Route::post('user/build/profile', 'fromCv');
     });
});