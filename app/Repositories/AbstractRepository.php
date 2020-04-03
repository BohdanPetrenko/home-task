<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function find($id): Model
    {
        return $this->model->findOrFail($id);
    }

    public function getAllPaginated(): Paginator
    {
        return $this->model->simplePaginate();
    }
}
