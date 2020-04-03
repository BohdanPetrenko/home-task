<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\TransactionLogRepository;
use App\Repositories\User\UserRepository;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function users(UserRepository $repository)
    {
        return view('admin.users', [
            'users' => $repository->getAllPaginated(),
        ]);
    }

    public function transactions(TransactionLogRepository $repository)
    {
        return view('admin.transactions', [
            'transactions' => $repository->getAllPaginated(),
        ]);
    }
}
