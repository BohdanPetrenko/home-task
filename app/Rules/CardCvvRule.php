<?php

namespace App\Rules;

class CardCvvRule extends AbstractCardRule
{
    public function message()
    {
        return __('messages.rules.cvv');
    }
}
