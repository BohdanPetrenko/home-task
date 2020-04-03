<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Jobs\TransferMoneyJob;
use App\Repositories\TransactionLogRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        return view('transaction.index');
    }

    public function transaction(TransactionRequest $request)
    {
        $this->dispatch(new TransferMoneyJob($request->all()));

        return view('transaction.index');
    }

    public function log(Request $request, TransactionLogRepository $repository, int $cardNumber)
    {
        if (! ($request->user()->hasCard($cardNumber) || $request->user()->isAdmin())) {
            throw new AuthorizationException();
        }

        return view('transaction.log', [
            'transactions' => $repository->getBySenderNumberPaginated($cardNumber),
        ]);
    }
}
