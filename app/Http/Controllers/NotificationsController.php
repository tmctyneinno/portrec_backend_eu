<?php

namespace App\Http\Controllers;

use App\Enums\NotificationTypes;
use App\Http\Controllers\Base\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Recruiter;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class NotificationsController extends BaseController
{
    public static function save($recruiterId = null, $userId = null, $notification_type = null, $title = null,  $message = null, $ref_id = null)
    {
        // $recuiter_id = $request->user()->id;
        $notification = Notification::create([
            'user_id' => $userId,
            'recruiter_id' => $recruiterId,
            'notification_type' => $notification_type,
            'title' => $title,
            'message' => $message,
            'ref_id' => $ref_id
        ]);

        return $notification;
    }

    public function unread(Request $request, $isUser = 'user')
    {
        $id = $request->user()->id;
        $notifications = Notification::select('id', 'title', 'message', 'notification_type', 'ref_id')
            ->where($isUser == 'user' ? 'user_id' : 'recruiter_id', $id)
            ->whereNull('read_at')
            ->limit(3)
            ->get();
        return response()->json($notifications, 200);
    }

    public function read($id)
    {
        $notification = Notification::find($id);
        if ($notification) $notification->update(['read_at' => Carbon::now()]);
        return response()->json($notification, 200);
    }
}
