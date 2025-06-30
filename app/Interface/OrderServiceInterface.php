<?php

namespace App\Interface;

interface OrderServiceInterface
{
   public function placeOrder($data);
   public function getOrderSummary($data);
   public function getOrderList($data);
   public function cancelOrder($data);
}