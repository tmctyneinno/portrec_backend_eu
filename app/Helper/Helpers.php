<?php

use App\Models\User;

if(!function_exists('getUserAttributes')){

    function getUserAttributes($user_id)
    {

        return User::where('id', $user_id)->first();
    }

}