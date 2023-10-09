<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class UserAuthController extends AuthController
{
    public function signup(Request $request)
    {
        $req["name"] = $request->fullName;
        $req['email'] = $request->email;
        $req['password'] = $request->password;

        // dd($req)
        $create = $this->create($req);
        if (is_string($create) || $create['error'])
            return $this->errorMessage($create);
        return $this->successMessage($create, "success", 201);
    }

    public function signin(Request $request)
    {
        $req['email'] = $request->email;
        $req['password'] = $request->password;

        $login = $this->login($req);
        if (!$login) return $this->errorMessage("invalid email or password", 404);
        if (is_string($login) || !$login)
            abort(404, $login);

        $token = $login->createToken("portrecToken")->plainTextToken;
        return $this->successMessage(["token" => $token], "login success");
    }
}
