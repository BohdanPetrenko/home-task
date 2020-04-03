@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add card</div>

                    <form class="form-horizontal" method="POST" action="{{ route('payment.card.store') }}">
                        <div class="card-body">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6">
                                    @include('layouts.card.components.card_number', [
                                    'value' => $data['cardNumber']
                                    ])
                                </div>
                                @include('layouts.card.components.card_cvv', [
                                    'value' => $data['cvv']
                                ])
                                @include('layouts.card.components.card_date', [
                                    'value' => $data['expiration']
                                ])
                            </div>
                            <div class="form-check-label">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_system" value="null" checked>
                                    <label class="form-check-label">
                                        Null
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_system" value="VISA">
                                    <label class="form-check-label">
                                        Visa
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_system" value="MASTERCARD">
                                    <label class="form-check-label">
                                        MasterCard
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection