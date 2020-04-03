<?php

namespace App\Http\Requests;

use App\PaymentCard;
use Illuminate\Foundation\Http\FormRequest;

class PaymentCardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'payment_system' => [
                'required',
                'regex:/^(' . \implode('|', \array_merge(PaymentCard::PAYMENT_SYSTEM, ['null'])) . ')$/m',
            ],
            'card_number' => ['required', 'numeric', 'unique:payment_cards,card_number'],
            'cvv' => ['required', 'numeric', 'regex:/^\d{3}$/'],
            'expiration' => ['required', 'date_format:m/y'],
        ];
    }
}
