@extends('layouts.app')

@section('content')
    <div class="card-header h3 font-weight-bold">
        Reward History
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Code</th>
            <th scope="col">Card</th>
            <th scope="col">Promotion</th>
            <th scope="col">Approved By</th>
        </tr>
        </thead>
        <tbody>
        @foreach($histories as $history)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $history->reward_code }}</td>
                <td>{{ $history->card->cardTemplate->name }}</td>
                <td>{{ $history->promotion->reward_name }}</td>
{{--
                <td>{{ $history->employee->user->fname.' '.$history->employee->user->lname.'  '.
                 $history->employee->branch->shop->name.' '.$history->employee->branch->name
                 }}</td>
--}}
                <td>{{ $history->employee->fname.' '.$history->employee->lname.'  '.
                 '[branch name]'.' [shop name]'
                 }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @if(count($histories) === 0)
        <div class="text-center">
            No content Available
        </div>
    @endif
@endsection