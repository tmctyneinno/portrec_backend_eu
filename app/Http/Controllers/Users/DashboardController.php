<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Interfaces\DashboardServiceInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function __construct(
        public readonly DashboardServiceInterface $dashboardService,
    ) {}

    public function userInfo(Request $request)
    {

        $info = $this->dashboardService->UserDashboardInfo($request);
        return response()->json($info, 200);
    }
}
