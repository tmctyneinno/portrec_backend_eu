<?php

namespace App\Services\Users;

use App\Interfaces\Users\InterviewInterface;
use App\Mail\InterviewAcceptanceMail;
use App\Models\Interview;
use Illuminate\Support\Facades\Mail;

class InterviewServices  implements InterviewInterface
{

    public function updateInterview($request)
    {
        $interview = Interview::whereId($request->interview_id)->first();
        if($interview)$interview->update(['candidate_approved' => $request->candidate_approved]);
        Mail::to($interview->recruiter->email)->send(new InterviewAcceptanceMail($interview));
        return $interview;
    }


    public function UserInterview()
    {
        $interviews = Interview::where('user_id', auth_user()->id)->paginate(10);
        return $interviews->load('getUser');

    }


}