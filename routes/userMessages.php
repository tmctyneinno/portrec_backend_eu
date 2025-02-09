<?php

namespace App\route;

use App\Http\Controllers\Recruiters\MessageController;
use Illuminate\Support\Facades\Route;

Route::prefix('messages')->controller(MessageController::class)->group(function () {
    Route::post('/', 'store');
    Route::get('/index', 'index');
    Route::get('/count', 'messagesCount');
    Route::put('/{conversationId}/mark-read', 'markAsRead');
    Route::get('/{conversationId}', 'show');
    Route::delete('/{id}', 'destroy');
});
