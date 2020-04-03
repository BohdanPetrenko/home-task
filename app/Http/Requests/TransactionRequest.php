<?php

namespace App\Http\Requests;

use App\Rules\BalanceRule;
use App\Rules\CardCvvRule;
use App\Rules\CardDateRule;
use App\Rules\LuhnRule;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @throws BindingResolutionException
     */
    public function rules()
    {
        return [
            'sender' => [
                'bail',
                'required',
                'numeric',
                'exists:payment_cards,card_number',
//                $this->container->make(LuhnRule::class),
            ],
            'cvv' => [
                'bail',
                'required',
                'regex:/^[0-9]{3}$/m',
                $this->container->make(CardCvvRule::class),
            ],
            'expiration' => [
                'bail',
                'required',
                'date_format:m/y',
                $this->container->make(CardDateRule::class),
            ],
            'recipient' => [
                'bail',
                'required',
                'numeric',
                'different:sender',
                'exists:payment_cards,card_number',
//                $this->container->make(LuhnRule::class),
            ],
            'transfer_amount' => [
                'bail',
                'required',
                'regex:/\d+([,.]\d{0,2})?/m',
                'not_regex:/^[0]([,.][0]{2})?$/m',
                $this->container->make(BalanceRule::class),
            ],
        ];
    }
}
