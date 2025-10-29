<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Interface\OrderServiceInterface;
use App\Domains\Orders\Requests\OrderListRequest;
use App\Http\Resources\ApiResponseResource;
use App\Http\Resources\OrderResponseResource;
use App\Domains\Orders\Requests\OrderSummaryRequest;



class OrderController extends Controller
{
    protected OrderServiceInterface $orderService;

    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }

    public function OrdersList(OrderListRequest $request){
        $orders = $this->orderService->getOrderList($request->validated());
        if (!empty($orders)) {
      return new ApiResponseResource(
        // $orders,
             OrderResponseResource::collection($orders),
            'orders list has been fetched successfully',
            200
        );
    }else {
        return new ApiResponseResource(
            $orders,    
            'No orders found for that customer in that location',
            404
        );
    }

    }

    public function PlaceOrder($request){
        $orders = $this->orderService->placeOrder($request);
        return new ApiResponseResource(
            $orders,
            'order has been placed successfully',
            200
        );
    }

    public function OrderSummary( $order_id){
        // $validated=$request->validated($request);
        $orders = $this->orderService->getOrderSummary( $order_id);
        return new ApiResponseResource(
            $orders,
            'order summary has been fetched successfully',
            200
        );
    }

    public function CancelOrder($request){
        $orders = $this->orderService->cancelOrder($request);
        return new ApiResponseResource(
            $orders,
            'order has been cancelled successfully',
            200
        );
    }
}