@extends('layouts.admin.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Registered</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $key => $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at }} </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                        <li class="page-item @if ($users->currentPage() === 1) disabled @endif">
                            <a class="page-link" href="{{ $users->previousPageUrl() }}">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link"> {{ $users->currentPage() }} </a></li>
                        <li class="page-item @if (!$users->hasMorePages()) disabled @endif">
                            <a class="page-link" href="{{ $users->nextPageUrl() }}">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection