<?php

namespace App\Http\Controllers\Recruiters;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function getUserProfile($user_id)
    {
        $user = User::where('id', $user_id)->first();
        $user->load('profile', 'education', 'resume', 'default_cover_letter', 'experience', 'portfolios', 'userResume', 'isTopCareer', 'skill', 'userAvatar');
        return response()->json(['data' => $user], 200);
    }
}
