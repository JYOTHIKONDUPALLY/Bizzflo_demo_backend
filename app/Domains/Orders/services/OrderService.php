<?php

namespace App\Domains\Orders\services;

use App\Interface\OrderServiceInterface;
use App\Domains\Orders\Actions\{PlaceOrderAction, OrderSummaryAction, GetOrderListAction, CancelOrderAction, OrderDetailsAction};

class OrderService implements OrderServiceInterface
{
        protected PlaceOrderAction $placeOrderAction;
        protected GetOrderListAction $getOrderListAction;
        protected OrderSummaryAction $orderSummaryAction;
        protected CancelOrderAction $cancelOrderAction;
        protected OrderDetailsAction $orderDetailsAction;

    public function __construct(PlaceOrderAction $placeOrderAction, GetOrderListAction $getOrderListAction, OrderSummaryAction $orderSummaryAction, CancelOrderAction $cancelOrderAction , OrderDetailsAction $orderDetailsAction){
        $this->placeOrderAction = $placeOrderAction;
        $this->getOrderListAction = $getOrderListAction;
        $this->orderSummaryAction = $orderSummaryAction;
        $this->cancelOrderAction = $cancelOrderAction;
        $this->orderDetailsAction = $orderDetailsAction;
    }

    public function placeOrder($data){
        return  $this->placeOrderAction->handle($data);
    }

    public function cancelOrder($data){
        return  $this->cancelOrderAction->handle($data);
    }

    public function getOrderList($data){
        return  $this->getOrderListAction->handle($data);
    }

    public function getOrderSummary($id){
        return  $this->orderSummaryAction->handle($id);
    }

    public function OrderDetails($id){
        return  $this->orderDetailsAction->handle($id);
    }
    
}