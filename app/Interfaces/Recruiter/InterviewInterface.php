<?php 
namespace App\Interfaces\Recruiter;

interface InterviewInterface
{
    
    public function GenerateToken();
    public function GenerateMeetingLink($request);
    public function UpdateMeetingInfo($request, $data);
    public function getAllInterviews();

}