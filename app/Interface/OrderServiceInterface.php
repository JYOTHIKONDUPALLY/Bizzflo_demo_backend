<?php

namespace App\Interface;

interface OrderServiceInterface
{
   public function placeOrder($data);
   public function OrderDetails($id);
   public function getOrderSummary($id);
   public function getOrderList($data);
   public function cancelOrder($data);
}