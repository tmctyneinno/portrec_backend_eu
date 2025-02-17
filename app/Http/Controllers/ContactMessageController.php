<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\BaseController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ContactMessageController extends BaseController
{
    public static function saveMessage(Request $request)
    {
        $ip_address = $request->ip();

        DB::table('contact_messages')->insert([
            'email' => $request->email,
            'firstname' => $request->input('firstname', null),
            'lastname' => $request->input('lastname', null),
            'message' => $request->input('message', ''),
            'ip_address' => $request->ip(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return response()->json(['success' => true], 200);
    }


    public function getMessages(Request $request)
    {

        $rowsPerPage = $request->query('rowsPerPage', 10);

        $messages = DB::table('contact_messages')
            ->orderBy('created_at', 'desc')
            ->paginate($rowsPerPage);

        $unread_count = DB::table('contact_messages')->where('is_read', 0)->count();

        return response()->json([
            'messages' => $messages,
            'unread_count' => $unread_count,
        ], 200);
    }


    public function readMessage($id)
    {
        $message = DB::table('contact_messages')->where('id', $id)->first();

        if (!$message) {
            return response()->json(['error' => 'Message not found'], 404);
        }

        DB::table('contact_messages')->where('id', $id)->update(['is_read' => 1]);

        return response()->json(['message' => 'Message marked as read'], 200);
    }

    public function deleteMessages(Request $request)
    {
        $ids = $request->ids;

        if (!is_array($ids) || empty($ids)) {
            return response()->json(['success' => false, 'message' => 'Invalid or empty ID list'], 400);
        }

        DB::table('contact_messages')->whereIn('id', $ids)->delete();
        return response()->json(['success' => true, 'message' => 'deleted'], 200);
    }
}
