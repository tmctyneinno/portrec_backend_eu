<?php

namespace App\Http\Controllers\User;

use App\Helper\FileUpload;
use App\Http\Controllers\Base\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\Trait\UserTrait;
use App\Models\UserResume;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ResumeController extends BaseController
{
    use UserTrait;
    public function uploadResume(Request $request)
    {
        $userId = $this->userID()->id;
        $resp = FileUpload::uploadFile($request->file("file"), "resume");
        if ($resp instanceof Response) return $resp;

        $request['doc_url'] = $resp;
        $request['user_id'] = $userId;
        $request['doc_name'] = $request->name ?? "";
        $upload = UserResume::create($request->all());
        return $this->successMessage($upload);
    }

    public function deleteResume($id)
    {
        $userId =  $this->userID()->id;
        UserResume::where([
            "id", "=", $id,
            "user_id", "=",  $userId
        ])->delete();
        return $this->successMessage("", "", 204);
    }
}
