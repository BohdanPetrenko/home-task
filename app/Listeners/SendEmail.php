<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\CardAdded;
use App\Mail\CardAddedMail;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailer;

class SendEmail
{
    private Mailer $mailer;

    private Request $request;

    public function __construct(Mailer $mailer, Request $request)
    {
        $this->request = $request;
        $this->mailer = $mailer;
    }

    public function handle(CardAdded $event)
    {
        return $this->mailer->to($event->getPaymentCard()->user)->queue(new CardAddedMail($this->request->input()));
    }
}