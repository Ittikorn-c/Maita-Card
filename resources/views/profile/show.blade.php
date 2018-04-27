@extends('layouts.app')

@section('page-title')
User Profile
@endsection

@section('content')
<div class="container-fluid panel panel-default">
    <div class="panel-heading m-3 p-2">
        <h2>User Profile : {{ $user->username }}</h2>
        <p>[ <i class="fa fa-user-circle"></i> 
           {{ $user->role }} ]</p>
    </div>
    <div class="row m-3 p-2" style="background-color:lightblue">
        <div class="col-sm-1">
            
        </div>
        <div class="col-sm-4 m-1 p-2" style="background-color:white">
            {{ $user->profile_img }}
        </div>
        <div class="col-sm-6 m-1 p-2">
            <ul class="list-group">
                <li class="list-group-item">First Name: {{ $user->fname }}</li>
                <li class="list-group-item">Last Name: {{ $user->lname }}</li>
                <li class="list-group-item">Email: {{ $user->email }}</li>
                <li class="list-group-item">Email Status: {{ $user->status }}</li>
                <li class="list-group-item">Phone: {{ $user->phone }}</li>
                <li class="list-group-item">Gender: {{ $user->gender }}</li>
                <li class="list-group-item">Address: {{ $user->address }}</li>
                <li class="list-group-item">Joining Date: {{ $user->created_at->diffForHumans() }}</li>
            </ul>
        </div>
    </div>
    <div class="row col-sm-3 m-3 p-2 panel-footer">
        <a class="btn btn-info" href="/profile/{{ $user->id }}/edit">Edit</a>
        <from  action="/users/{{ $user->id }}" method="post">
            @csrf
        </from>
    </div>
</div>

@endsection
