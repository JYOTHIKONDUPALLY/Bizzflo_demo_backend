<?php

namespace App\Interface;

interface OrderServiceInterface
{
   public function placeOrder($data);
<<<<<<< HEAD
=======
   public function OrderDetails($id);
>>>>>>> 06caea9a819f808ad58d5ff3ac872d51153c422a
   public function getOrderSummary($id);
   public function getOrderList($data);
   public function cancelOrder($data);
}