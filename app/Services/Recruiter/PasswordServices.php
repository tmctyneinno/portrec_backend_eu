<?php 

namespace App\Services\Recruiter;

use App\Interfaces\Recruiter\PasswordInterface;
use App\Mail\RecruiterOtpEmail;
use App\Mail\SendOtpMail;
use App\Models\PasswordOtp;
use App\Models\Recruiter;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;



class PasswordServices implements PasswordInterface
{
    public function verifyOTPEmail($request)
    {
        $recruiter = Recruiter::where('email', $request->email)->first();
        if($recruiter)
        {
            $otp = rand(111111,999999);
        Mail::to($recruiter->email)->send(new RecruiterOtpEmail(
            [
                'name' => $recruiter->name,
                'otp' => $otp
            ]
            ));

        $password = PasswordOtp::where('user_id', $recruiter->id)->get();
        if($password) $password->each(fn($e) => $e->delete());
        PasswordOtp::create([
           'user_id' => $recruiter->id,
            'otp' => $otp, 
            'status' => 1,
             'expiry' => Carbon::now()->addMinute(10)
        ]);
        }

        return $recruiter;

    }
    public function verifyOTP($request){
        $otp = PasswordOtp::where(['user_id' => $request->recruiter_id, 'otp' => $request->otp])->latest()->first();
        if($otp && $otp->expiry > Carbon::now())
        {   
            return 
            ['message' => 'Otp verified successfully',
            'recruiter' => Recruiter::find($request->recruiter_id)];
        }
       return false;
    }


    public function ResetPassword($request)
    {
        $recruiter = Recruiter::where('id', $request->recruiter_id)->first();
        $otp = PasswordOtp::where(['user_id' => $recruiter->id, 'otp' => $request->otp])->latest()->first();
        if(!$otp) return false;
        if($recruiter)
        {
            $recruiter->update([
                'password' => Hash::make($request->password)
            ]);
        return [
        'message' => 'Password updated', 
        'recruiter' => $recruiter];
        $otp->delete();
        }
        return false;
    }
    public function changePassword($request){}
}