@extends('layouts.app')

@section('content')
<form class="form-horizontal" action="/profile/{{ $user->id }}" method="post">
    @method('PUT')
    {{ csrf_field() }}
    <div class="container panel panel-default card">
        <div class="panel-heading m-3 p-2">
            <h2>Edit Profile : {{ $user->username }}</h2>
            <p>[ <i class="fa fa-user-circle"></i> {{ $user->role }} ]</p>
        </div>
        <div class="row m-3 p-2 form-group">
            <label class="control-label col-sm-2" for="username">Username: </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="username" name="username" value="{{ old('username') ??  $user->username }}" />
            </div>
            @if($errors->any())
                <div class="row m-3 p-2 text-danger">
                    {{ $errors->first('username') }}
                </div>
            @endif
        </div>
        <div class="row m-3 p-2 form-group">
            <label class="control-label col-sm-2" for="fname">First Name: </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="fname" name="fname" value="{{ old('fname') ?? $user->fname }}" />
            </div>
            @if($errors->any())
                <div class="row m-3 p-2 text-danger">
                    {{ $errors->first('fname') }}
                </div>
            @endif
        </div>
        <div class="row m-3 p-2 form-group">
            <label class="control-label col-sm-2" for="lname">Last Name: </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="lname" name="lname" value="{{ old('lname') ?? $user->lname }}" />
            </div>
            @if($errors->any())
                <div class="row m-3 p-2 text-danger">
                    {{ $errors->first('lname') }}
                </div>
            @endif
        </div>
        <div class="row m-3 p-2 form-group">
            <label class="control-label col-sm-2" for="gender">Gender: </label>
            <div class="col-sm-10">
                <label class="radio-inline">
                    <input type="radio" name="gender" value="{{ old('gender') ?? $user->gender }}"@if(old('gender',$user->gender)=="male") checked @endif>Male
                </label>
                <label class="radio-inline">
                    <input type="radio" name="gender" value="{{ old('gender') ?? $user->gender }}" @if(old('gender',$user->gender)=="female") checked @endif>Female
                </label>
                <!-- <input type="text" class="form-control" id="gender" name="gender"  /> -->
            </div>
            @if($errors->any())
                <div class="row m-3 p-2 text-danger">
                    {{ $errors->first('gender') }}
                </div>
            @endif
        </div>
        <div class="row m-3 p-2 form-group">
            <label class="control-label col-sm-2" for="email">Email:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') ?? $user->email }}" />
            </div>
            @if($errors->any())
                <div class="row m-3 p-2 text-danger">
                    {{ $errors->first('email') }}
                </div>
            @endif
        </div>
        <div class="row m-3 p-2 form-group">
            <label class="control-label col-sm-2" for="address">Address: </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address') ?? $user->address }}" />
            </div>
            @if($errors->any())
                <div class="row m-3 p-2 text-danger">
                    {{ $errors->first('address') }}
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
    <div class="row col-sm-1 m-3 p-2">
        <button class="btn btn-info m-3 p-2" tyoe="submit">Submit</button>
    </div>
    
</form>

@endsection