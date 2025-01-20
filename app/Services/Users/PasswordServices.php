<?php 

namespace App\Services\Users;

use App\Interfaces\Users\PasswordInterface;
use App\Mail\SendOtpMail;
use App\Models\PasswordOtp;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class PasswordServices implements PasswordInterface
{
    public function verifyOTPEmail($request)
    {
        $user = User::where('email', $request->email)->first();
        if($user)
        {
            $otp = rand(111111,999999);
        Mail::to($user->email)->send(new SendOtpMail(
            [
                'name' => $user->name,
                'otp' => $otp
            ]
            ));

        PasswordOtp::create([

            ''
        ]);

        }

    }
    public function verifyOTP($request){}
    public function updatePassword($request){}
    public function changePassword($request){}
}