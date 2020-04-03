<?php

declare(strict_types=1);

namespace app\Rules;

use App\PaymentCard;
use App\Repositories\PaymentCardRepository;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Hashing\HashManager;
use Illuminate\Http\Request;

abstract class AbstractCardRule implements Rule
{
    protected ?PaymentCard $card;

    protected HashManager $hash;

    public function __construct(PaymentCardRepository $repository, Request $request, HashManager $hash)
    {
        $this->hash = $hash;
        $this->setCard($repository, $request);
    }

    private function setCard(PaymentCardRepository $repository, Request $request): void
    {
        try {
            $this->card = $repository->findByNumber((int)$request->input('sender'));
        } catch (ModelNotFoundException $e) {
            $this->card = null;
        }
    }

    public function passes($attribute, $value)
    {
        return is_null($this->card)
            ? false
            : $this->hash->check($value, $this->card->$attribute);
    }
}
