<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function successMessage($body, $message = "", $code = 200)
    {
        return response([
            "status" => "success",
            "body" => $body,
            "message" => $message
        ], $code);
    }

    public function errorMessage($error, $code = 400)
    {
        return response([
            "status" => "fail",
            "message" => $error
        ], $code);
    }
}
