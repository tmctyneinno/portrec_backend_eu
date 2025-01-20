<?php 

namespace App\Services\Users;

use App\Interfaces\Users\PasswordInterface;
use App\Mail\SendOtpMail;
use App\Models\PasswordOtp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use function PHPUnit\Framework\throwException;

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

        $password = PasswordOtp::where('user_id', $user->id)->get();
        if($password) $password->delete();
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
        $otp = PasswordOtp::where(['user_id' => $request->user_id, 'otp' => $request->otp])->latest()->first();
        if($otp && $otp->expiry > Carbon::now())
        {   
            return 
            ['message' => 'Otp verified successfully',
            'user' => User::find($request->user_id)];
        }
       return false;
    }


    public function ResetPassword($request)
    {
        $user = User::where('id', $request->user_id)->first();
        $otp = PasswordOtp::where(['user_id' => $user->id, 'otp' => $request->otp])->latest()->first();
        if($otp) return false;
        if($user)
        {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        return [
        'message' => 'Password updated', 
        'user' => $user];
        $otp->delete();
        }
        return false;
    }
    public function changePassword($request){}
}