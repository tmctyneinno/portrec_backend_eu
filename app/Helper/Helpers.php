<?php

use App\Models\User;

if(!function_exists('getUserAttributes')){

    function getUserAttributes($user_id)
    {

        return User::where('id', $user_id)->first();
    }
}


function auth_user() 
{
    return auth()->user();
}

function auth_recruiter()
{
    return auth('recruiter')->user();
}

function getUserLocationData()
{
// $getIP = request()->ip();  
$getIP = '41.210.11.223';
$url = "ipinfo.io/$getIP?token=882a5aae24fada";
return curlRequest($url);
}




function curlRequest($url)
{

 $curl = curl_init();
curl_setopt_array($curl, [
 CURLOPT_URL => $url,
 CURLOPT_RETURNTRANSFER => true,
 CURLOPT_HTTPHEADER => [
     'Content-Type: application/json'
 ]
 ]);
 $resp = curl_exec($curl);
 $url_close = curl_close($curl);
 $res = json_decode($resp, true);
 return $res;
}
