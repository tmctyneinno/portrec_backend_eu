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
        if (is_string($create) || $create['validation']) {
            $errors = $create['errors'];
            $email = $errors["email"][0];
            $phone = $errors["phone"][0];

            if ($email == "The email has already been taken." || $email == "The phone has already been taken.") $this->errorMessage($create, 209);

            return $this->errorMessage($create);
        }
    }

    public function signin(Request $request)
    {
        $req['email'] = $request->email;
        $req['password'] = $request->password;

        $login = $this->login($req, "recruiter");
        if (is_string($login))
            return $this->errorMessage($login, 401);
        $token = $login->createToken("recruiterPortreToken")->plainTextToken;
        return $this->successMessage(["token" => $token], "login");
    }
}
