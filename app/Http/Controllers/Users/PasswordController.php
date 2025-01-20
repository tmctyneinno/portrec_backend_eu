<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use App\Interfaces\Users\PasswordInterface;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
  

    public function __construct(
        public readonly PasswordInterface $passwordServices
    )
    {
        
    }

    public function verifyOTPEmail(PasswordRequest $request)
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
        $otp = $this->passwordServices->verifyOTP($request);
        return $otp;
    }

    public function ResetPassword(PasswordRequest $request)
    {
        $password = $this->passwordServices->ResetPassword($request);
        return $password;
    }


}
