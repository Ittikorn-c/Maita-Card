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
                <th scope="col">Card</th>
                <th scope="col">Promotion</th>
                <th scope="col">Shop</th>
                <th scope="col">Approved By</th>
            </tr>
            </thead>
            <tbody>
            @foreach($histories as $history)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $history->card->cardTemplate->name }}</td>
                    <td>{{ $history->promotion->reward_name }}</td>
                    <td>{{ $history->card->cardTemplate->shop->name/*.' ,branch-'.
                 \App\Employee::where('id', $history->employee->id)->first()->branch->name*/ }}</td>
                    <td>{{ $history->employee->fname.' '.$history->employee->lname }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @if(count($histories) === 0)
            <div class="text-center">
                No content Available
            </div>
        @endif
    </div>

@endsection