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
        <div class="row m-3 p-2">
        <div class="col-sm-4 p-2 bg-white card">
            <img src="/images/profile/{{ $user->profile_img }}" style="width:100%;max-width:400px"/>
            <div class="row justify-content-center">
                <div class="form-group m-1 p-2">
                    <input type="file" class="form-control-file" name="avatar" id="avatarFile" aria-describedby="fileHelp">
                    <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>
                </div>
                <button type="submit" class="btn btn-primary">Change</button>
            </div>
        </div>
        <div class="col-sm-8 p-2 bg-white card">
        <div class="row m-3 p-2 form-group">
            <label class="control-label col-sm-2" for="username">Username: </label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="username" name="username" value="{{ old('username') ??  $user->username }}" />
            </div>
            @if($errors->first('username'))
                <div class="row m-1 p-1 text-danger">
                    {{ $errors->first('username') }}
                </div>
            @endif
        </div>
        <div class="row m-3 p-2 form-group">
            <label class="control-label col-sm-2" for="fname">First Name: </label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="fname" name="fname" value="{{ old('fname') ?? $user->fname }}" />
            </div>
            <label class="control-label col-sm-2" for="lname">Last Name: </label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="lname" name="lname" value="{{ old('lname') ?? $user->lname }}" />
            </div>
            @if($errors->first('fname') || $errors->first('lname'))
                <div class="row m-1 p-1 text-danger">
                    @if($errors->first('fname'))
                        {{ $errors->first('fname') }}
                    @endif
                    @if($errors->first('fname') and $errors->first('lname'))
                        and
                    @endif
                    @if($errors->first('lname'))
                        {{ $errors->first('lname') }}
                    @endif
                </div>
            @endif          
        </div>
        <div class="row m-3 p-2 form-group">
            <label class="control-label col-sm-2" for="gender">Gender: </label>
            <div class="col-sm-4">
                <label class="radio-inline">
                    <input type="radio" name="gender" value="male"@if(old('gender',$user->gender)=="male") checked @endif>Male
                </label>
                <label class="radio-inline">
                    <input type="radio" name="gender" value="female" @if(old('gender',$user->gender)=="female") checked @endif>Female
                </label>
            </div>
            @if($errors->first('gender'))
                <div class="row m-1 p-1 text-danger">
                    {{ $errors->first('gender') }}
                </div>
            @endif
        </div>
        <div class="row m-3 p-2 form-group">
            <label class="control-label col-sm-2" for="email">Email:</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') ?? $user->email }}" />
            </div>
            @if($errors->first('email'))
                <div class="row m-1 p-1 text-danger">
                    {{ $errors->first('email') }}
                </div>
            @endif
        </div>
        <div class="row m-3 p-2 form-group">
            <label class="control-label col-sm-2" for="address">Address: </label>
            <div class="col-sm-6">
                <textarea class="form-control" rows="2" id="address" onKeyPress name="address" value="{{ old('address') ?? $user->address }}" />{{ old('address') ?? $user->address }}</textarea>
            </div>
            @if($errors->first('address'))
                <div class="row m-1 p-1 text-danger">
                    {{ $errors->first('address') }}
                </div>
            @endif
        </div>
        <div class="row m-3 p-2 form-group">
            <label class="control-label col-sm-2" for="phone">Phone Number:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') ?? $user->phone }}" />
            </div>
            @if($errors->first('phone'))
                <div class="row m-1 p-1 text-danger">
                    {{ $errors->first('phone') }}
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
        </div>
        </div>
    <br>
    <div class="row col-sm-1 m-3 p-2">
        <button class="btn btn-info m-3 p-2" tyoe="submit">Save</button>
    </div>
    
</form>

@endsection