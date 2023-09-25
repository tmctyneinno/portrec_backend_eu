<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends BaseController
{
    public function __construct(public $user)
    {
        // $this->middleware("");
        // if (!$user) return $this->errorMessage("unauthorized");
    }
    public function updateProfile(Request $request, $id)
    {
        User::where("id", $id)->update($request->all());
    }
}
