<?php 

namespace App\Interfaces\Users;

interface PasswordInterface
{

    public function verifyOTPEmail($request);
    public function verifyOTP($request);
    public function updatePassword($request);
    public function changePassword($request);



}