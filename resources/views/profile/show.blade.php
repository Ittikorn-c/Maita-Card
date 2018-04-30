@extends('layouts.app')

@section('content')
<div class="container panel panel-default card">
    <div class="panel-heading m-3 p-2">
        <h2>Profile : {{ $user->username }}</h2>
        <p>[ <i class="fa fa-user-circle"></i> {{ $user->role }} ]</p>
    </div>
    <div class="row m-3 p-2 bg-secondary">
        <div class="col-sm-1">
            
        </div>
        <div class="col-sm-4 p-2 bg-white card">
            <img src='{{ asset("storage/profile/$user->profile_img") }}' style="width:100%;max-width:400px">
        </div>
        <div class="col-sm-6 m-1 p-2">
            <ul class="list-group">
                <li class="list-group-item">First Name: {{ $user->fname }}</li>
                <li class="list-group-item">Last Name: {{ $user->lname }}</li>
                <li class="list-group-item">Email: {{ $user->email }}</li>
                <li class="list-group-item">Status: {{ $user->status }}</li>
                <li class="list-group-item">Phone: {{ $user->phone }}</li>
                <li class="list-group-item">Gender: {{ $user->gender }}</li>
                <li class="list-group-item">Address: {{ $user->address }}</li>
                <li class="list-group-item">Joining Date: {{ $user->created_at->diffForHumans() }}</li>
            </ul>
        </div>
    </div>
    <div class="row m-3 p-2 panel-footer">
        @if(Auth::user()->id === $user->id )
        <div class="m-1 p-1">
            <a class="btn btn-info" href="/profile/{{ $user->id }}/edit">Edit</a>
        </div>
            @if(Auth::user()->role === 'customer' )
            <div class="m-1 p-1">
                <a class="btn btn-success" href='/reward_history'>Reward history</a>
            </div>
            <div class="m-1 p-1">    
                <a class="btn btn-success" href='{{ url("/". Auth::user()->id) . "/qr-code/My"}}'>QR code</a>
            </div>
            <div class="m-1 p-1 dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Select Card
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @foreach($cards as $card)
                        <a class="dropdown-item" value="{{ $card->id }}" href='/cards/{{ $card->id }}'>{{ $card->cardTemplate->name }} {{ $card->point }} point</a>
                    @endforeach
                </div>
            </div>
            @endif
            @if(Auth::user()->role === 'owner' )
            <div class="m-1 p-1"> 
                <a class="btn btn-danger" href='/maitahome/shops/allshops'>Shop Management</a>
            </div>
            @endif
        
        @endif
        
        
    </div>
</div>

@endsection
