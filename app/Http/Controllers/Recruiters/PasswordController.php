<?php

namespace App\Http\Controllers\Recruiters;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use App\Interfaces\Recruiter\PasswordInterface;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    
    public function __construct(
        public readonly PasswordInterface $passwordServices
    )
    {
        
    }

    public function sendOTPEmail(PasswordRequest $request)
    {
        
        try{
            $res = $this->passwordServices->verifyOTPEmail($request);
         return response()->json(['data' => $res]);
        }catch(\Exception $e)
    {
        return response()->json(['error' => $e->getMessage()]); ;
    }
  
    }

    public function verifyOTP(PasswordRequest $request)
    {
        try{
        $otp = $this->passwordServices->verifyOTP($request);
        if($otp) return response()->json(['data' => $otp]);
        return response()->json(['error' =>'Otp not correct or expired']); ;
       }catch(\Exception $e)
     {
    return response()->json(['error' => $e->getMessage()]); ;
}
    }

    public function ResetPassword(PasswordRequest $request)
    {
        try{
            $password = $this->passwordServices->ResetPassword($request);
            if($password) return response()->json(['data' => $password]);
            return response()->json(['error' =>'Request Failed, try again']); ;
           }catch(\Exception $e)
         {
        return response()->json(['error' => $e->getMessage()]); ;
        }

  }
}
