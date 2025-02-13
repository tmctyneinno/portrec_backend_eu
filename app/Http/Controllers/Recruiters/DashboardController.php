<?php

namespace App\Http\Controllers\Recruiters;

use App\Enums\NotificationTypes;
use App\Http\Controllers\Base\BaseController;
use App\Http\Controllers\Controller;
use App\Interfaces\DashboardServiceInterface;
use App\Models\Notification;
use App\Models\Recruiter;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class DashboardController extends BaseController
{

    public function __construct(
        public readonly DashboardServiceInterface $dashboardService,
    ) {}

    public function userInfo(Request $request)
    {

        $info = $this->dashboardService->UserDashboardInfo($request);
        return response()->json($info, 200);
    }

    public function recruiterInfo(Request $request)
    {
        $info = $this->dashboardService->RecruiterDashboardInfo($request);
        return response()->json($info, 200);
    }
}
