<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Base\BaseController;
use App\Http\Controllers\User\Trait\UserTrait;
use App\Models\Application;
use App\Models\ApplicationAnswer;
use Illuminate\Http\Request;

class JobApplicationController extends BaseController
{
    use UserTrait;
    public function applyForJob(Request $request, $id)
    {
        $user_id = $this->userID()->id;
        $req['job_id'] = $id;
        $req['user_id'] = $user_id;
        $req['applid_date'] = now();
        $req['cover_letter_id'] = $request->coverLetterId;
        $req['cv_id'] = $request->resumeId;
        $req['applid_date'] = now();
        $application = Application::create($req);

        $appId = $application->id;
        $answer = $request->answers;

        if ($answer) {
            foreach ($answer as $key => $value) {
                $answer[$key]['application_id'] = $appId;
                $answer[$key]['questions'] = $answer[$key]['questionId'];
                $answer[$key]['user_id'] = $user_id;
                $answer[$key]['answers'] = $answer[$key]['answer'];
                unset($answer[$key]['questionId']);
                unset($answer[$key]['answer']);
            }
            ApplicationAnswer::insert($answer);
        }

        return $this->successMessage("", "application submitted successfully");
    }
}
