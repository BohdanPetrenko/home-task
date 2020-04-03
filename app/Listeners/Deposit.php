<?php

namespace App\Listeners;

use App\Events\CardAdded;
use Illuminate\Contracts\Queue\ShouldQueue;

class Deposit implements ShouldQueue
{
    public function handle(CardAdded $event)
    {
        $event->getPaymentCard()->balance()->create(['balance' => 50]);
    }
}
