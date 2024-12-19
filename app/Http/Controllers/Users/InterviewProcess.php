<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Interfaces\Users\InterviewInterface;
use Illuminate\Http\Request;

class InterviewProcess extends Controller
{
    //

    public function __construct(
        public readonly InterviewInterface $interview
    )
    {
    }

    public function AcceptInterview(Request $request)
    {
        $interview = $this->interview->updateInterview($request);
        return $interview;
    }

    public function getUserInterview()
    {
        return $this->interview->UserInterview();
    }

}
