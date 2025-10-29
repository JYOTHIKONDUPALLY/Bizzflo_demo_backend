<?php

namespace App\Domains\Orders\services;

use App\Interface\OrderServiceInterface;
<<<<<<< HEAD
use App\Domains\Orders\Actions\{PlaceOrderAction, OrderSummaryAction, GetOrderListAction, CancelOrderAction};
=======
use App\Domains\Orders\Actions\{PlaceOrderAction, OrderSummaryAction, GetOrderListAction, CancelOrderAction, OrderDetailsAction};
>>>>>>> 06caea9a819f808ad58d5ff3ac872d51153c422a

class OrderService implements OrderServiceInterface
{
        protected PlaceOrderAction $placeOrderAction;
        protected GetOrderListAction $getOrderListAction;
        protected OrderSummaryAction $orderSummaryAction;
        protected CancelOrderAction $cancelOrderAction;
<<<<<<< HEAD

    public function __construct(PlaceOrderAction $placeOrderAction, GetOrderListAction $getOrderListAction, OrderSummaryAction $orderSummaryAction, CancelOrderAction $cancelOrderAction){
=======
        protected OrderDetailsAction $orderDetailsAction;

    public function __construct(PlaceOrderAction $placeOrderAction, GetOrderListAction $getOrderListAction, OrderSummaryAction $orderSummaryAction, CancelOrderAction $cancelOrderAction , OrderDetailsAction $orderDetailsAction){
>>>>>>> 06caea9a819f808ad58d5ff3ac872d51153c422a
        $this->placeOrderAction = $placeOrderAction;
        $this->getOrderListAction = $getOrderListAction;
        $this->orderSummaryAction = $orderSummaryAction;
        $this->cancelOrderAction = $cancelOrderAction;
<<<<<<< HEAD
=======
        $this->orderDetailsAction = $orderDetailsAction;
>>>>>>> 06caea9a819f808ad58d5ff3ac872d51153c422a
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
<<<<<<< HEAD
=======

    public function OrderDetails($id){
        return  $this->orderDetailsAction->handle($id);
    }
>>>>>>> 06caea9a819f808ad58d5ff3ac872d51153c422a
    
}