<?php

declare(strict_types=1);

namespace App\Repositories;

use App\TransactionLog;
use Illuminate\Contracts\Pagination\Paginator;

class TransactionLogRepository extends AbstractRepository
{
    public function __construct(TransactionLog $model)
    {
        parent::__construct($model);
    }

    public function getBySenderNumberPaginated(int $cardNumber): Paginator
    {
        return $this->model->where('sender', $cardNumber)->orderBy('transaction_at', 'DESC')->simplePaginate();
    }
}