@extends('layouts.app')

@section('page-title')
User Profile
@endsection

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h2>User Profile : {{ $user->username }}</h2>
    </div>
    <div class="row m-3 p-2">
        <div class="col-sm-1">
            
        </div>
        <div class="col-sm-4">
            Pic
        </div>
        <div class="col-sm-6">
            <ul class="list-group">
                <li class="list-group-item">First Name: {{ $user->fname }}</li>
                <li class="list-group-item">Last Name: {{ $user->lname }}</li>
                <li class="list-group-item">Email: {{ $user->email }}</li>
                <li class="list-group-item">Address: {{ $user->address }}</li>
                <li class="list-group-item">Joining Date: {{ $user->created_at->diffForHumans() }}</li>
            </ul>
        </div>
    </div>
</div>

@endsection
