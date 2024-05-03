<?php

namespace App\Http\Controllers\Users;

use App\Helper\FileUpload;
use App\Http\Controllers\Base\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\Trait\UserTrait;
use App\Http\Resources\UserResource;
use App\Interfaces\UserServiceInterface;
use App\Models\CoverLetter;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class CoverLetterController extends BaseController
{
    use UserTrait;

    public function __construct(
        public readonly UserServiceInterface $userService,
    ) {
    }

    public function setDefaultCoverLetter($id, Request $request)
    {

        $user = $this->userService->setDefaultCoverLetter($id);

        if ($user === false) {
            throw ValidationException::withMessages([
                'message' => 'You cannot set another user\'s cover letter as your default'
            ]);
        }

        if ($user === null) {
            return $this->errorMessage('Service unavailable, please try again later', Response::HTTP_SERVICE_UNAVAILABLE);
        }

        return $this->successMessage([
            'resume' => new UserResource($user->fresh()),
        ]);
    }

    public function uploadCoverLetter(Request $request)
    {
        $userId = $this->userID()->id;
        $resp = FileUpload::uploadFile($request->file("file"), "coverLetters");
        if ($resp instanceof Response) return $resp;

        $request['doc_url'] = $resp;
        $request['user_id'] = $userId;

        $upload = CoverLetter::create([
            "doc_url" => $resp,
            "user_id" => $userId
        ]);
        return $this->successMessage($upload);
    }

    public function writeCoverLetter(Request $request)
    {
        $id = $this->userID()->id;
        $data['user_id'] = $id;
        $data['content'] = $request->content;
        $resume = CoverLetter::create($data);
        return $this->successMessage($resume);
    }

    public function updateCoverLetter(Request $request, $id)
    {
        $userId = $this->userID()->id;
        $letter = CoverLetter::where(['user_id' => $userId, 'id' => $id])->first();
        $letter->update(['content' => $request->content]);
        return $this->successMessage($letter, 200);
    }

    public function deleteCoverLetter($id)
    {
        $userId = $this->userID()->id;
        CoverLetter::where($this->condition($id, $userId))->delete();
        return $this->successMessage("", "", 204);
    }
}
