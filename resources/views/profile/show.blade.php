@extends('layouts.app')

@section('page-title')
User Profile
@endsection

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h2>{{ $user->username }}</h2>
    </div>
    <ul class="list-group">
      <li class="list-group-item">First Name: {{ $user->fname }}</li>
      <li class="list-group-item">Email: {{ $user->email }}</li>
      <li class="list-group-item">
        Joining Date: {{ $user->created_at->diffForHumans() }}
      </li>
    </ul>
</div>
@endsection
