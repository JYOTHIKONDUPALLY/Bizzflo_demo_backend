<?php

namespace App\Domains\Orders\services;

use App\Interface\OrderServiceInterface;
use App\Domains\Orders\Actions\{PlaceOrderAction, OrderSummaryAction, GetOrderListAction, CancelOrderAction};

class OrderService implements OrderServiceInterface
{
        protected PlaceOrderAction $placeOrderAction;
        protected GetOrderListAction $getOrderListAction;
        protected OrderSummaryAction $orderSummaryAction;
        protected CancelOrderAction $cancelOrderAction;

    public function __construct(PlaceOrderAction $placeOrderAction, GetOrderListAction $getOrderListAction, OrderSummaryAction $orderSummaryAction, CancelOrderAction $cancelOrderAction){
        $this->placeOrderAction = $placeOrderAction;
        $this->getOrderListAction = $getOrderListAction;
        $this->orderSummaryAction = $orderSummaryAction;
        $this->cancelOrderAction = $cancelOrderAction;
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

    public function getOrderSummary($data){
        return  $this->orderSummaryAction->handle($data);
    }
    
}