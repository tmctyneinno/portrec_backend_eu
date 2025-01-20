<?php 

namespace App\Services\Users;

use App\Interfaces\Users\PasswordInterface;
use App\Mail\SendOtpMail;
use App\Models\PasswordOtp;
use App\Models\User;
use Carbon\Carbon;
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
           'user_id' => $user->id,
            'otp' => $otp, 
            'status' => 1,
             'expiry' => Carbon::now()->addMinute(10)
        ]);
        }

        return $user;

    }
    public function verifyOTP($request){
        $otp = PasswordOtp::where(['user_id' => $request->user_id, 'otp' => $request->otp])->first();
        if($otp && $otp->expiry > Carbon::now())
        {   
            $otp->delete();
            return true;
        }
        return false;
    }
    public function ResetPassword($request)
    {
        $user = User::where('user_id', $request->user_id)->first();
        if($user)
        {
            $user->update([
                'password' => $request->password
            ]);
        }

    }
    public function changePassword($request){}
}