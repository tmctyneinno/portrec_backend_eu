<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthRequest;
use App\Http\Requests\UserRequest;
use App\Models\Recruiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RecruiterAuthController extends AuthController
{
    public function signup(UserRequest $request)
    {
        $validation = $request->validated();

        $req["name"] = $validation['fullName'];
        $req['email'] = $validation['email'];
        $req['password'] = bcrypt($validation['password']);
        // $req['role'] = "recruiter";
        $req['phone'] = $validation['phone'];

        if (Recruiter::where('email', $validation['email'])->exists()) {
            return response()->json('Email Already Taken', 203);
        }

        if (Recruiter::where('phone', $validation['phone'])->exists()) {
            return response()->json('Phone Number Already Taken', 203);
        }

        DB::beginTransaction();
        try {
            $recruiter = Recruiter::create($req);
            $recruiter->password = $validation['password'];
            // if ($recruiter) {
            // event(new CreaterecruiterProfile($recruiter));
            // event(new RegistrationEmails($validation));
            // }

            $data = [
                'recruiter' => $recruiter,
                $recruiter->profile
            ];
            DB::commit();
            return $this->successMessage($data, "success", 201);
        } catch (\Exception $e) {
            DB::rollBack();
            //  dd($e);
            return $this->errorMessage($e->getMessage(), 409);
        }
    }



    public function signin(Request $request)
    {
        $recruiter = Recruiter::where('email', $request->email)->first();

        if (!$recruiter || !Hash::check($request->password, $recruiter->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $recruiter->createToken('recruiterPortreToken')->plainTextToken;
        return $this->successMessage(["token" => $token, 'recruiter' => $recruiter], "login success");
    }




    // public function signin(Request $request)
    // {
    //     $req['email'] = $request->email;
    //     $req['password'] = $request->password;

    //     $login = $this->login($req, "recruiter");
    //     // return $login;
    //     if (is_string($login))
    //         return $this->errorMessage($login, 401);
    //     $token = $login->createToken("recruiterPortreToken")->plainTextToken;
    //     return $this->successMessage(["token" => $token], "login");
    // }
}
