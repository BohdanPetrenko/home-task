@extends('layouts.admin.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Sender</th>
                        <th scope="col">Recipient</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($transactions as $key => $transaction)
                        <tr>
                            <th scope="row">{{ $transaction->id }}</th>
                            <td>{{ $transaction->sender }}</td>
                            <td>{{ $transaction->recipient }}</td>
                            <td>{{ $transaction->transfer_amount }} </td>
                            <td>{{ $transaction->created_at }} </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                        <li class="page-item @if ($transactions->currentPage() === 1) disabled @endif">
                            <a class="page-link" href="{{ $transactions->previousPageUrl() }}">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link"> {{ $transactions->currentPage() }} </a></li>
                        <li class="page-item @if (!$transactions->hasMorePages()) disabled @endif">
                            <a class="page-link" href="{{ $transactions->nextPageUrl() }}">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection