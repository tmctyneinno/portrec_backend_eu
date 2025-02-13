<?php

use App\Http\Controllers\NewLetterEmailsController;
use App\Http\Controllers\Recruiters\TopCareerController as RecruitersTopCareerController;
use App\Http\Controllers\Users\CompanyController;
use App\Http\Controllers\Users\SkillController;
use Illuminate\Support\Facades\Route;


Route::get("skills", [SkillController::class, "getSkill"]);

Route::controller(CompanyController::class)->group(function () {
    Route::get('companies/{type?}/{param?}', 'Index');
    Route::get('company/details/{company_id}', 'CompanyDetails');
});

Route::controller(RecruitersTopCareerController::class)->group(function () {
    Route::get('/get/industry/careers/{id}', 'getIndustryCareer');
    Route::post('/get/all/careers/', 'getAllCareers');
});


// New Letters
Route::prefix("newletters")->group(function () {
    Route::post("save/email", [NewLetterEmailsController::class, "saveEmail"]);
    Route::post("activate/deactivate/email", [NewLetterEmailsController::class, "activateDeactivateEmail"]);
    Route::get("get/emails", [NewLetterEmailsController::class, "getAllEmails"]);
});
