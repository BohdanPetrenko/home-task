<?php

namespace App\Events;

use App\PaymentCard;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CardAdded
{
    use Dispatchable, SerializesModels;

    private PaymentCard $paymentCard;

    public function __construct(PaymentCard $paymentCard)
    {
        $this->paymentCard = $paymentCard;
    }

    public function getPaymentCard(): PaymentCard
    {
        return $this->paymentCard;
    }
}
