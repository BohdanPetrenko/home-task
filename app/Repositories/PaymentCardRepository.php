<?php

declare(strict_types=1);

namespace App\Repositories;

use App\PaymentCard;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PaymentCardRepository extends AbstractRepository
{
    public function __construct(PaymentCard $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $cardNumber
     *
     * @return PaymentCard
     * @throws ModelNotFoundException
     */
    public function findByNumber(int $cardNumber): PaymentCard
    {
        return $this->model->where('card_number', $cardNumber)->firstOrFail();
    }
}
