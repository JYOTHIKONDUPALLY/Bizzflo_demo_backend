<?php   

namespace App\Interface;

interface DashboardServiceInterface{
    public function dashboardData($request);
    public function TopSelling();
    public function TopRevenueByLocations();
}