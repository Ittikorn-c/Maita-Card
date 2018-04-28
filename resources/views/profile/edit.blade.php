@extends('layouts.app')

@section('content')
<form action="/profile/{{ $user->id }}" method="post">
    @method('PUT')
    {{ csrf_field() }}
    <div class="container-fluid panel panel-default card">
        <div class="panel-heading m-3 p-2">
            <h2>Edit Profile : {{ $user->username }}</h2>
            <p>[ <i class="fa fa-user-circle"></i> {{ $user->role }} ]</p>
        </div>
        <div class="row m-3 p-2 form-group">
            <label>Username: </label>
            <input type="text" name="username" value="{{ old('username') ?? $user->username }}" />
            @if($errors->any())
                <div class="text-danger">
                    {{ $errors->first('username') }}
                </div>
            @endif
        </div>
        <div class="row m-3 p-2 form-group">
            <label>First Name: </label>
            <input type="text" name="fname" value="{{ old('fname') ?? $user->fname }}" />
            @if($errors->any())
                <div class="text-danger">
                    {{ $errors->first('fname') }}
                </div>
            @endif
        </div>
        <div class="row m-3 p-2 form-group">
            <label for="email">Email: </label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') ?? $user->email }}" />
            @if($errors->any())
                <div class="text-danger">
                    {{ $errors->first('email') }}
                </div>
            @endif
        </div>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    <br>
    </div>
    <button class="btn btn-info m-3 p-2" tyoe="submit">Submit</button>
</form>

@endsection