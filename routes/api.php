<?php

use App\Http\Controllers\FeatureJobsController;
use App\Http\Controllers\Recruiters\FeatureJobsController as RecruitersFeatureJobsController;
use App\Http\Controllers\Recruiters\ScheduleInterview;
use App\Http\Controllers\Users\{
    SkillController,
    CompanyController,
    SubscriptionController
};

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



require __DIR__.'/socialLogin.php';
require __DIR__.'/user.php';
require __DIR__.'/job.php';
require __DIR__ . '/recruiter.php';
require __DIR__.'/landing.php';


Route::middleware(['auth:sanctum'])->group(function () {
    require __DIR__.'/cvBuilder.php';
    require  __DIR__.'/userMessages.php';
    require  __DIR__.'/userNotification.php';
});

Route::post('candidate/accept/', [ScheduleInterview::class, 'AcceptInterview']);
Route::get('/get/featured/jobs', [RecruitersFeatureJobsController::class,'FeatureJobs']);
Route::get('user/verify/payment/', [SubscriptionController::class,'handleFlutterCallback']);
Route::get('recruiter/verify/payment/', [SubscriptionController::class,'handleFlutterCallback']);

require __DIR__.'/interviewProcesses.php';
require __DIR__.'/userSubscription.php';
require __DIR__.'/recruiterSubscription.php';
require __DIR__.'/UserResetPassword.php';
require __DIR__.'/recruiterResetPassword.php';
