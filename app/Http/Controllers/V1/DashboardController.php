<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Interface\DashboardServiceInterface;
use App\Domains\Dashboard\Services\DashboardService;
use App\Http\Resources\ApiResponseResource;
use App\Domains\Dashboard\Request\DashboardDataRequest;
use App\Domains\User\Models\User;
use App\Exceptions\UserException;

class DashboardController extends Controller
{

    protected DashboardServiceInterface $dashboardService;

    public function __construct(DashboardServiceInterface $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }
    public function dashboardData(DashboardDataRequest $request)
    {
        try {
            $validated = $request->validated();
            $data = $this->dashboardService->dashboardData($validated);
            return new ApiResponseResource($data, "Dashboard Data", 200);
        } catch (UserException $e) {
            return response()->json(new ApiResponseResource(
                null,
                $e->getMessage(),
                $e->getCode() ?: 401,
                true
            ), $e->getCode() ?: 401);
        } catch (\Throwable $e) {
            return response()->json(new ApiResponseResource(
                null,
                'Internal Server Error: ' . $e->getMessage(),
                500
            ), 500);
        }
    }
    public function TopSelling()
    {
        try {
            $data = $this->dashboardService->TopSelling();
            return new ApiResponseResource($data, "Dashboard Data", 200);
        } catch (UserException $e) {
            return response()->json(new ApiResponseResource(
                null,
                $e->getMessage(),
                $e->getCode() ?: 401,
                true
            ), $e->getCode() ?: 401);
        } catch (\Throwable $e) {
            return response()->json(new ApiResponseResource(
                null,
                'Internal Server Error: ' . $e->getMessage(),
                500
            ), 500);
        }
    }

    public function TopRevenueByLocations(){
        try{
            $data = $this->dashboardService->TopRevenueByLocations();
            return new ApiResponseResource($data, "Dashboard Data", 200);
        }catch(UserException $e){
            return response()->json(new ApiResponseResource(
                null,
                $e->getMessage(),
                $e->getCode() ?: 401,
                true
            ),$e->getCode() ?: 401);
        }catch(\Throwable $e){
            return response()->json(new ApiResponseResource(
                null,
                'Internal Server Error: ' . $e->getMessage(),
                500
            ), 500);
        }
    }
}
