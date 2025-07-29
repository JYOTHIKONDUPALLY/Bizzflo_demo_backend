<?php

namespace App\Domains\Dashboard\Services;

use App\Interface\DashboardServiceInterface;
use App\Domains\Dashboard\Actions\DashboardDataAction;
use App\Domains\Dashboard\Actions\TopSellingAction;
use App\Domains\Dashboard\Actions\TopRevenueByLocationsAction;

class DashboardService implements DashboardServiceInterface
{
    protected DashboardDataAction $dashboardDataAction;
    protected TopSellingAction $TopSellingAction;
    protected TopRevenueByLocationsAction $TopRevenueByLocationsAction;

    public function __construct(DashboardDataAction $dashboardDataAction,TopSellingAction $TopSellingAction, TopRevenueByLocationsAction $TopRevenueByLocationsAction)
    {
        $this->dashboardDataAction = $dashboardDataAction;
        $this->TopSellingAction = $TopSellingAction;
        $this->TopRevenueByLocationsAction = $TopRevenueByLocationsAction;
    }
     public function dashboardData($request)
    {
       return $this->dashboardDataAction->handle($request);
    }
    public function TopSelling()
    {
        return $this->TopSellingAction->handle();
    }

    public function TopRevenueByLocations()
    {
       return $this->TopRevenueByLocationsAction->handle();
    }
   
}