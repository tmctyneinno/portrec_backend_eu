<?php

namespace App\Services\Recruiter;

use App\Services\Recruiter\ClientBase;
use App\Interfaces\Recruiter\InterviewInterface;
use App\Models\Interview;
use App\Models\ZoomClient;
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
        $token = $request['token'];
        $request['settings'] =
            [
                'host_video' => true,
                'participant_video' => true,
            ];

        $meeting =  $this->client->post('https://api.zoom.us/v2/users/me/meetings', [
            'headers' => [
                'Authorization' => "Bearer $token",
                'Content-Type'  => 'application/json',
            ],
            'body' => json_encode($request),
        ]);

        if ($meeting) {
            Interview::create([
                'user_id' => $request['user_id'],
                'recruiter_id' => auth('recruiter')->id,
                'job_application_id' => $request['job_application_id'],
                'assigned_to' => $meeting['host_email'],
                'interview_channel_id' => $request['channel'],
                'location' => $request['location'],
                'interview_date' => $request['start_time'],
                'status' => $meeting['status'],
                'description' => $request['topic'],
                'password' => $meeting['password'],
                'meeting_id' => $meeting['id'],
                'join_url' => $meeting['join_url'],
                'host_url' => $meeting['start_url']
            ]);
        }

        return $meeting;
    }


    public function UpdateMeetingInfo() {}
}
