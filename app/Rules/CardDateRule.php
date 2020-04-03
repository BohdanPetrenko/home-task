<?php

namespace App\Rules;

class CardDateRule extends AbstractCardRule
{
    public function message()
    {
        return __('messages.rules.date');
    }
}
