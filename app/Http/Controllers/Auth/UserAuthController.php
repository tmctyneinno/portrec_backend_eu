<?php

namespace App\Http\Controllers\Auth;

use App\Events\CreateUserProfile;
use App\Events\RegistrationEmails;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;

class UserAuthController extends AuthController
{
    public function signup(UserRequest $request)
    {
        $validation = $request->validated();

        $req["name"] = $validation['fullName'];
        $req['email'] = $validation['email'];
        $req['password'] = bcrypt($validation['password']);
        $req['role'] = "user";
        $req['phone'] = $validation['phone'];

      DB::beginTransaction();  
try {
        $user = User::create($req);
        $user->password = $validation['password'];
        if($user){
            event( new CreateUserProfile($user));
             event(new RegistrationEmails($validation));
        }

        $data = [
            'user' => $user,
            $user->profile
        ];
    DB::commit();
    return $this->successMessage($data, "success", 201);
    }catch(\Exception $e){
     DB::rollBack();
    //  dd($e);
     return $this->errorMessage($e->getMessage(), 201);
    }

    }

    public function signin(Request $request)
    {
        $req['email'] = $request->email;
        $req['password'] = $request->password;

        $login = $this->login($req);
        if (is_string($login) || !$login)
            return $this->errorMessage($login, 401);

        $token = $login->createToken("portrecToken")->plainTextToken;
        return $this->successMessage(["token" => $token, 'user' => $login], "login success");
    }

    public function changePassword(Request $request)
    {
        
    }
}