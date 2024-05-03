<?php

namespace App\Http\Controllers\Users;

use App\Helper\FileUpload;
use App\Http\Controllers\Base\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\Trait\UserTrait;
use App\Http\Resources\UserResource;
use App\Interfaces\UserServiceInterface;
use App\Models\UserResume;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class ResumeController extends BaseController
{
    use UserTrait;

    public function __construct(
        public readonly UserServiceInterface $userService,
    ) {
    }

    public function setDefaultResume($id, Request $request)
    {
        $user = $this->userService->setDefaultResume($id);

        if ($user === false) {
            throw ValidationException::withMessages([
                'message' => 'You cannot set another user\'s resume as your default'
            ]);
        }

        if ($user === null) {
            return $this->errorMessage('Service unavailable, please try again later', Response::HTTP_SERVICE_UNAVAILABLE);
        }

        return $this->successMessage([
            'resume' => new UserResource($user->fresh()),
        ]);
    }

    public function uploadResume(Request $request)
    {
        $userId = $this->userID()->id;
        $resp = FileUpload::uploadFile($request->file("file"), "resume");

        if ($resp instanceof Response) return $resp;

        $req['doc_url'] = $resp;
        $req['user_id'] = $userId;
        $req['doc_name'] = $request->name ?? "";
        $upload = UserResume::create($req);
        return $this->successMessage($upload);
    }

    public function deleteResume($id)
    {
        $userId =  $this->userID()->id;
        UserResume::where([
            ["id", "=", $id],
            ["user_id", "=",  $userId]
        ])->delete();
        return $this->successMessage("", "", 204);
    }
}
