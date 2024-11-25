<?php

use App\Http\Controllers\NotificationsController;
use Illuminate\Support\Facades\Route;




Route::get("notifications/user", [NotificationsController::class, "unread"]);
Route::get("notification/read/{id}", [NotificationsController::class, "read"]);