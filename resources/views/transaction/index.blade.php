@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Money Transfer</div>

                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="{{ route('transaction.make') }}">
                            @method('PATCH')
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6">
                                    @include('layouts.card.components.card_number', [
                                    'label' => 'Transfer from',
                                    'name' => 'sender'
                                    ])
                                </div>
                                @include('layouts.card.components.card_cvv')
                                @include('layouts.card.components.card_date')
                            </div>

                            <div class="form-group">
                                @include('layouts.card.components.card_number', [
                                'label' => 'Transfer to',
                                'name' => 'recipient',
                                'placeholder' => 'recipient card number'
                                ])

                                <label for="transfer_amount">Transfer Amount</label>
                                <input type="text" class="form-control" name="transfer_amount"
                                       required
                                       pattern="\d+([,.]\d{0,2})?"
                                       value="{{ old('transfer_amount') ?? '0,00' }}">
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop