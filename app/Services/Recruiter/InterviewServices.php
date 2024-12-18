<?php

namespace App\Services\Recruiter;

use App\Services\Recruiter\ClientBase;
use App\Interfaces\Recruiter\InterviewInterface;
use App\Mail\InterviewInvitationMail;
use App\Models\Interview;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Mail;

class InterviewServices  implements InterviewInterface
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function GenerateToken()
    {
        $client_id = getenv('ZOOM_CLIENT_ID');
        $client_secret = getenv('ZOOM_CLIENT_SECRET');

        $res  = $this->client->post('https://zoom.us/oauth/token', [
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode($client_id . ':' . $client_secret),
            ],
            'form_params' => [
                'grant_type' => 'account_credentials',
                'account_id' => '-S93IG5fQlGzj8W5RkhuQA',
            ]
        ]);

        return json_decode($res->getBody());
    }


    public function GenerateMeetingLink($request)
    {
        $users =  getUserAttributes($request->user_id);
        if($request->meeting_type == 'online'){
        try{
        $token = $this->GenerateToken();
            $tokens = $token->access_token;
        $data = $request->only(['topic', 'start_time', 'duration', 'UTC']);
        $data['type'] = 2;
        $data['settings'] =
            [
                'host_video' => true,
                'participant_video' => true,
            ];
        $meeting =  $this->client->post('https://api.zoom.us/v2/users/me/meetings', [
            'headers' => [
                'Authorization' => "Bearer $tokens",
                'Content-Type'  => 'application/json',
            ],
            'body' => json_encode($data),
        ]);
        // if($request->meeting_type == 'online' &&  isset($meeting)){
        $meeting = json_decode($meeting->getBody(), true);
        $emailData = self::UpdateMeetingInfo($request, $meeting);
        $emailData['user'] = $users;
        Mail::to($users->email)->send(new InterviewInvitationMail($emailData));
        return $emailData;
        }catch(\Exception $e)
        {
            return false;
        }
    }else{
      $data = $this->UpdateMeetingInfo($request, ''); 
      $data['user'] = $users;
      Mail::to($users->email)->send(new InterviewInvitationMail($data));
      return $data;
    }
    return false;
    }


    public function UpdateMeetingInfo($request, $meeting) {
      return  Interview::create([
            'user_id' => $request->user_id,
            'recruiter_id' => 1,
            'job_application_id' => $request->job_application_id,
            'assigned_to' => $meeting['host_email']??'',
            'interview_channel_id' => $request['channel'],
            'location' => $request->location,
            'interview_date' => Carbon::parse($request->start_time)->format('Y-m-d H:i:s'),
            'status' => $meeting['status']??'active',
            'description' => $request['topic'],
            'password' => $meeting['password']??'',
            'meeting_id' => $meeting['id']??'',
            'join_url' => $meeting['join_url']??'',
            'host_url' => $meeting['start_url']??'',
            'message' => $request->message
        ]);

    }

    public function getAllInterviews()
    {
        return Interview::where('recruiter_id', 1)->get();
    }


    public function updateInterview($request)
    {
        $interview = Interview::whereId($request->interview_id)->first();
        if($interview)$interview->update(['candidate_approved' => $request->candidate_approved]);
        return $interview;
    }
}
