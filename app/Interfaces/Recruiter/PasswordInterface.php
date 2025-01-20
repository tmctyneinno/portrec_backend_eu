<?php 

namespace App\Interfaces\Recruiter;

interface PasswordInterface
{
    public function verifyOTPEmail($request);
    public function verifyOTP($request);
    public function ResetPassword($request);
    public function changePassword($request);
}