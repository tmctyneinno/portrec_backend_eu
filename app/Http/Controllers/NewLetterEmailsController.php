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


class NewLetterEmailsController extends BaseController
{
    public static function saveEmail(Request $request)
    {
        $email = $request->email;
        $ip_address = $request->ip();

        $exists = DB::table('newsletter_emails')
            ->where('email', $email)
            ->where('ip_address', $ip_address)
            ->exists();

        if (!$exists) {
            DB::table('newsletter_emails')->insert([
                'email' => $email,
                'ip_address' => $ip_address,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

        return response()->json(['success' => true], 200);
    }

    public function activateDeactivateEmail(Request $request)
    {
        $ids = $request->ids;

        if (!is_array($ids) || empty($ids)) {
            return response()->json(['success' => false, 'message' => 'Invalid or empty ID list'], 400);
        }

        DB::table('newsletter_emails')
            ->whereIn('id', $ids)
            ->update(['is_active' => (bool) $request->is_active]);

        return response()->json(['success' => true], 200);
    }

    public function getAllEmails()
    {
        $emails = DB::table('newsletter_emails')
            ->select('email', 'is_active')
            ->get()
            ->groupBy('is_active');

        return response()->json([
            'active' => $emails->get(1, []),
            'inactive' => $emails->get(0, [])
        ], 200);
    }


    public function deleteEmails(Request $request)
    {
        $ids = $request->ids;

        if (!is_array($ids) || empty($ids)) {
            return response()->json(['success' => false, 'message' => 'Invalid or empty ID list'], 400);
        }

        DB::table('newsletter_emails')->whereIn('id', $ids)->delete();
        return response()->json(['success' => false, 'message' => 'deleted'], 200);
    }
}
