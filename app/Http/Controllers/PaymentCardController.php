<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentCardRequest;
use App\Services\PaymentCard\CreateManager;
use App\Services\PaymentCard\SaveManager;
use Illuminate\Http\Request;

final class PaymentCardController extends Controller
{
    public function index(Request $request)
    {
        return view('payment.index', [
            'user' => $request->user()->with('paymentCard')->first(),
        ]);
    }

    public function create(CreateManager $manager)
    {
        return view('payment.create', [
            'data' => $manager->getDefaultValues($this),
        ]);
    }

    public function store(PaymentCardRequest $request, SaveManager $manager)
    {
        $manager->store($request->user(), $request->validated(), $this);

        return view('payment.index', [
            'user' => $request->user()->with('paymentCard')->first(),
        ]);
    }
}
