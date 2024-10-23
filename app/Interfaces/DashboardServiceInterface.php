<?php

namespace App\Interfaces;

interface DashboardServiceInterface
{
    public function RecruiterDashboardInfo($request): array;
    public function UserDashboardInfo($request): array;
    public function UserUpcomingInterviews($request);
}
