<?php

namespace App\Services\Recruiter;

use App\Services\Recruiter\ClientBase;
use App\Interfaces\Recruiter\InterviewInterface;
use App\Models\Interview;
use GuzzleHttp\Client;

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
        if($request->meeting_type == 'online'){
        $token = $this->GenerateToken();
        if($token)
        {
            $tokens = $token->access_token;
        $data = $request->only(['topic','type', 'start_time', 'duration', 'UTC']);
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
        if($request->meeting_type == 'online' &&  isset($meeting))
        $meeting = json_decode($meeting->getBody(), true);
        self::UpdateMeetingInfo($request, $meeting);
        }
    }else
    {
       $this->UpdateMeetingInfo($request, ''); 
    }
    return false;
    }


    public function UpdateMeetingInfo($request, $meeting) {
        Interview::create([
            'user_id' => $request->user_id,
            'recruiter_id' => 1,
            'job_application_id' => $request->job_application_id,
            'assigned_to' => $meeting['host_email']??$request['host_email'],
            'interview_channel_id' => $request['channel'],
            'location' => $request->location,
            'interview_date' => $meeting['start_time']??$request['start_time'],
            'status' => $meeting['status']??'active',
            'description' => $request['topic'],
            'password' => $meeting['password']??'',
            'meeting_id' => $meeting['id']??'',
            'join_url' => $meeting['join_url']??'',
            'host_url' => $meeting['start_url']??''
        ]);

    }
}
