<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CardAddedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private array $params;

    public function __construct(array $cardParams)
    {
        $this->params = $cardParams;
    }

    public function build()
    {
        return $this->markdown('emails.card.card_added')->with('data', $this->params);
    }
}
