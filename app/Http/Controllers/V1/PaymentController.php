<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Interface\PaymentServiceInterface;
use App\Domains\Payment\Requests\{InitiatePaymentRequest,ConfirmPaymentRequest, PaymentHistoryRequest, paymentStatusRequest, RefundPaymentRequest};
use App\Http\Resources\ApiResponseResource;

class PaymentController extends Controller
{
    protected PaymentServiceInterface $paymentService;

    public function __construct(PaymentServiceInterface $paymentService)
    {
        $this->paymentService = $paymentService;
    }   
    public function InitiatePayment(InitiatePaymentRequest $request){
        $validated= $request->validated();
        $payment = $this->paymentService->initiatePayment($validated);
        return new ApiResponseResource($payment,"Payment Initiated Successfully",200);
    }

    public function ConfirmPayment(ConfirmPaymentRequest $request){
        $validated= $request->validated();
        $payment = $this->paymentService->confirmPayment($validated);
        return new ApiResponseResource($payment,"Payment Confirmed Successfully",200);
         
    }

    public function PaymentHistory( PaymentHistoryRequest $request){
        $validated= $request->validated();
        $payment = $this->paymentService->paymentHistory($validated);
        return new ApiResponseResource($payment,"Payment History",200);
    }

    public function paymentStatus( paymentStatusRequest $request){
        $validated= $request->validated();
        $payment = $this->paymentService->paymentStatus($validated);
        return new ApiResponseResource($payment,"Payment Status",200);
    }
    public function RefundPayment(RefundPaymentRequest $request){
        $validated= $request->validated();
        $payment = $this->paymentService->refundPayment($validated);
        return new ApiResponseResource($payment,"Payment Refunded Successfully",200);   
    }
}