@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">My cards</div>
                    <table class="table table-bordered">

                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Card number</th>
                            <th>Added</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($cards as $key => $userCard)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td><a href=" {{ route('transaction.show', ['cardNumber' => $userCard->card_number]) }} ">
                                        {{ $userCard->card_number }}
                                    </a>
                                </td>
                                <td>{{ $userCard->created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
