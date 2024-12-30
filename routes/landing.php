<?php

use App\Http\Controllers\Users\CompanyController;
use App\Http\Controllers\Users\SkillController;

use App\Http\Controllers\TopCareerController;
use App\Models\TopCareer;
use Illuminate\Support\Facades\Route;


Route::get("skills", [SkillController::class, "getSkill"]);

Route::controller(CompanyController::class)->group(function () {
    Route::get('companies/{type?}/{param?}', 'Index');
    Route::get('company/details/{company_id}', 'CompanyDetails');
});

Route::controller(TopCareerController::class)->group(function () {
    Route::get('/get/industry/careers/{id}', 'getIndustryCareer');
    Route::post('/get/all/careers/', 'getAllCareers');
});
