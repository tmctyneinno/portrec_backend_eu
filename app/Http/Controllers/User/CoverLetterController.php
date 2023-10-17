<?php

namespace App\Http\Controllers\User;

use App\Helper\FileUpload;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\Trait\UserTrait;
use App\Models\CoverLetter;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CoverLetterController extends Controller
{
    use UserTrait;

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
        $request['user_id'] = $id;
        $resume = CoverLetter::create($request->all());
        return $this->successMessage($resume);
    }

    public function updateCoverLetter(Request $request, $id)
    {
        $userId = $this->userID()->id;
        $letter = CoverLetter::where($this->condition($id, $userId))->update($request->all());
        return $this->successMessage($letter);
    }

    public function deleteCoverLetter($id)
    {
        $userId = $this->userID()->id;
        CoverLetter::where($this->condition($id, $userId))->delete();
        return $this->successMessage("", "", 204);
    }
}
