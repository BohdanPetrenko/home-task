<?php

namespace App\Rules;

use App\Repositories\PaymentCardRepository;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class BalanceRule implements Rule
{
    private PaymentCardRepository $repository;

    private array $requestData;

    public function __construct(PaymentCardRepository $repository, Request $request)
    {
        $this->repository = $repository;
        $this->requestData = $request->all();
    }

    public function passes($attribute, $value)
    {
        try {
            $card = $this->repository->findByNumber($this->requestData['sender']);
        } catch (ModelNotFoundException $e){
            return false;
        }

        return $card->balance->balance >= $value;
    }

    public function message()
    {
        return __('messages.rules.balance');
    }
}
