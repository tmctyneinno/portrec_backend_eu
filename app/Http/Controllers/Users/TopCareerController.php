<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Services\Users\topCareerService;
use Illuminate\Http\Request;

class TopCareerController extends Controller
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
            if($career)
            return  $this->successMessage($career, 'success', 200);
            }catch(\Exception $e)
        {
            $this->errorMessage($e->getMessage(), 302);
        }
    }

    public function getAllCareers()
    {
        try{
        $career = $this->topCareerService->fetchRandCareer();
        if($career)
        return  $this->successMessage($career, 'success', 200);
        }catch(\Exception $e)
    {
        $this->errorMessage($e->getMessage(), 302);
    }
    }

}
