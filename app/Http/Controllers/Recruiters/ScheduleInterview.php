<?php

namespace App\Http\Controllers\Recruiters;

use App\Http\Controllers\Controller;
use App\Interfaces\Recruiter\InterviewInterface;
use Illuminate\Http\Request;

class ScheduleInterview extends Controller
{

    public function __construct(
        public readonly InterviewInterface $interview
    )
    {
    }

    public function generateInterviewToken()
    {
         return $this->interview->GenerateToken();
    }

    public function GenerateMeetingLink(Request $request)
    {
        $meeting = $this->interview->GenerateMeetingLink($request);
        return $meeting;
    }

    public function AcceptInterview(Request $params)
    {
        return $params;
    }
}
