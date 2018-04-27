@extends('layouts.app')

@section('content')
<form action="/profile/{{ $user->id }}" method="post">
    @method('PUT')
    {{ csrf_field() }}
    {{ $errors }}
    <h2>User Profile : {{ $user->username }}</h2>
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
    <label>Username: </label>
    <input type="text" name="username" value="{{ old('username') ?? $user->username }}" />
        @if($errors->any())
        <div class="text-danger">
            {{ $errors->first('username') }}
        </div>
        @endif
    <br>
    <label>Name: </label>
    <input type="text" name="fname" value="{{ old('fname') ?? $user->fname }}" />
        @if($errors->any())
        <div class="text-danger">
            {{ $errors->first('fname') }}
        </div>
        @endif
    <br>

    <label>Email: </label>
    <input type="text" name="email" value="{{ old('email') ?? $user->email }}" />
        @if($errors->any())
        <div class="text-danger">
            {{ $errors->first('email') }}
        </div>
        @endif
    <br>
    <button tyoe="submit">Submit</button>

</form>

@endsection