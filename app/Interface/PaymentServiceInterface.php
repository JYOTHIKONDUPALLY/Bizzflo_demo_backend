<?php

namespace App\Interface;

interface PaymentServiceInterface
{
   public function initiatePayment($request);
   public function confirmPayment($request);
   public function refundPayment($request);
   public function PaymentHistory($request);
   public function paymentStatus($request);
}