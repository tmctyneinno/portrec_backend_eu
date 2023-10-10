<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecruiterAuthController extends AuthController
{
    public function signup(Request $request)
    {
        $req["name"] = $request->fullName;
        $req['email'] = $request->email;
        $req['password'] = $request->password;
        $req['phone'] = $request->phone;

        $create = $this->create($req, "recruiter");
        if (is_string($create) || $create['error'])
            return $this->errorMessage($create);
        return $this->successMessage($create, "success", 201);
    }

    public function signin(Request $request)
    {
        $req['email'] = $request->email;
        $req['password'] = $request->password;

        $login = $this->login($req, "recruiter");
        if (is_string($login))
            return $this->errorMessage($login);
        $token = $login->createToken("recruiterPortreToken")->plainTextToken;
        return $this->successMessage(["token" => $token], "login");
    }
}