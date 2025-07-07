<?php

namespace App\Domains\Payment\Services;

use App\Interface\PaymentServiceInterface;
use App\Domains\Payment\Actions\{ConfirmPaymentAction, InitiatePaymentAction, PaymentHistoryAction, PaymentStatusAction, RefundPaymentAction};
use Illuminate\Console\View\Components\Confirm;

class PaymentService implements PaymentServiceInterface
{

    protected ConfirmPaymentAction $confirmPaymentAction;
    protected PaymentHistoryAction $historyAction;
    protected PaymentStatusAction $paymentStatusAction;
    protected RefundPaymentAction $refundPaymentAction;
    protected InitiatePaymentAction $initiatePaymentAction;
    public function __construct(
        ConfirmPaymentAction $confirmPaymentAction,
        PaymentHistoryAction $historyAction,
        PaymentStatusAction $paymentStatusAction,
        RefundPaymentAction $refundPaymentAction,
        InitiatePaymentAction $initiatePaymentAction){
            $this->confirmPaymentAction = $confirmPaymentAction;
            $this->historyAction = $historyAction;
            $this->paymentStatusAction = $paymentStatusAction;
            $this->refundPaymentAction = $refundPaymentAction;
            $this->initiatePaymentAction = $initiatePaymentAction;
    }
    public function confirmPayment(  $payment){
        return $this->confirmPaymentAction->handle($payment);
    }
    public function initiatePayment( $payment ){
        return $this->initiatePaymentAction->handle($payment);
    }    
    public function refundPayment( $payment ){
        return $this->refundPaymentAction->handle($payment);
    }
    public function PaymentHistory( $payment ){
        return $this->historyAction->handle($payment);
    }
    public function paymentStatus( $payment ){
        return $this->paymentStatusAction->handle($payment);
    }

}
?>