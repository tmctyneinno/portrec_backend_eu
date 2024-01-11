<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Base\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Recruiter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{
    public function create($request, $type = "user")
    {
        $validateEmail = Validator::make($request, [
            "name" => "required",
            "email" => "required|email|unique:users|unique:recruiters",
            "password" => "required",
        ]);
        // required:recruiters|unique:users|unique:recruiters|numeric

        if ($validateEmail->fails()) {
            return [
                "error" => true,
                "validation" => "fail",
                "errors" => $validateEmail->errors()->getMessages()
            ];
        }
        $password = bcrypt($request['password']);
        $request['password'] = $password;
        if ($type !== "user" && $type !== "recruiter")
            return "unable to create user";

        if ($type === "user")
            return User::create($request);

        if ($type === "recruiter")
            return Recruiter::create($request);
    }

    public function login($request, $auth = "")
    {
        $authenticate = auth($auth)->attempt(["email" => $request['email'], "password" => $request['password']]);
        // dd($auth);
        // dd($authenticate);
        if (!$authenticate) {
            return "invalid email or password";
        }


        /** 
         * @var  \App\Models\User; 
         * @var  \App\Models\Recruiter; 
         * @var  \App\Models\Admin; 
         */
        $user = auth($auth)->user();
        return $user;
    }

    public function forgetPassword()
    {
    }

    public function verifyEmail()
    {
    }

    public function resetPassword()
    {
    }
}
