<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Recruiter\topCareerService;
use App\Http\Controllers\Base\BaseController;
use Illuminate\Http\Request;

class TopCareerController extends BaseController
{
    public function __construct(
        public readonly topCareerService $topCareerService
    )
    {
        
    }

    public function getIndustryCareer($industries_id)
    {
        try{
            $career = $this->topCareerService->fetchIndustryCareer($industries_id);
            return  $this->successMessage($career, 'success', 200);
            }catch(\Exception $e){
           return $this->errorMessage($e->getMessage(), 302);
        }
    }

    public function getAllCareers(Request $request)
    {
        try{
        $career = $this->topCareerService->fetchRandCareer($request);
        return  $this->successMessage($career, 'success', 200);
        }catch(\Exception $e)
    {
        $this->errorMessage($e->getMessage(), 302);
    }
    }

}
