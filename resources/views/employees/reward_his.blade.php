@extends('layouts.app')

@section('content')
    <div class="card-header h3 font-weight-bold bg-dark text-white">
        Reward History
    </div>
    <div class="card-body">
        <table class="table">
            <thead class="bg-white">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Reward</th>
                <th scope="col">Shop</th>
                <th scope="col">Branch</th>
                <th scope="col">Given To</th>
                <th scope="col">Given At</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rewards as $reward)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $reward->reward_name }}</td>
                    <td>{{ $reward->name }}</td>
                    <td>{{ $reward->branch_name }}</td>
                    <td>{{ $reward->username }}</td>
                    <td>{{ $reward->created_at->diffForHumans() }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @if(count($rewards) === 0)
            <div class="h4 text-center">
                No Content Available
            </div>
        @endif
    </div>

@endsection