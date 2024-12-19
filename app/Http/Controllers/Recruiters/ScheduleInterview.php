<?php

namespace App\Http\Controllers\Recruiters;

use App\Http\Controllers\Controller;
use App\Interfaces\Recruiter\InterviewInterface;
use App\Models\Interview;
use Cloudinary\Api\HttpStatusCode;
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
        if($meeting)return response()->json($meeting, HttpStatusCode::OK);
        return  response()->json(['error' => 'request failed'], 302);
    }

    public function getAllInterviews()
    {
        $interview = $this->interview->getAllInterviews();
       return response()->json($interview, 200);
    }

    public function getMeetingDetails($meeting_id)
    {
        $meeting = Interview::where('id', $meeting_id)->first();
        if($meeting)
        {
             $meeting->load('getUser','getRecruiter', 'getJobs', 'company');
             return response()->json($meeting, HttpStatusCode::OK);  
        }
    return response()->json(['error' => 'request failed'], 302);
    }

    public function DeleteRecruiterInterview(Request $request)
    {
        $interview = $this->interview->DeleteInterview($request);
        if($interview) return response()->json(['data' => 'Interview Deleted Successfully'], HttpStatusCode::OK); 
        return response()->json(['data' => 'No Interview with the Id found'], 302);  
    }
}
