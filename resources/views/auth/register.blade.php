@extends('layouts.app')



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" id="register">
                        @csrf
                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                            
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fname" class="col-md-4 col-form-label text-md-right">{{ __('First name') }}</label>

                            <div class="col-md-6">
                                <input id="fname" value="{{ old('fname') }}" type="text" class="form-control" name="fname" required>
                                @if ($errors->has('fname'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('fname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lname" class="col-md-4 col-form-label text-md-right">{{ __('Last name') }}</label>

                            <div class="col-md-6">
                                <input id="lname" value="{{ old('lname') }}" type="text" class="form-control" name="lname" required>
                                @if ($errors->has('lname'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('lname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" value="{{ old('address') }}" type="text" class="form-control" name="address" required>
                            </div>
                            @if ($errors->has('address'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" value="{{ old('phone') }}" class="form-control" name="phone" required>
                            </div>
                            @if ($errors->has('phone'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="birth_date" class="col-md-4 col-form-label text-md-right">{{ __('Birth Date') }}</label>

                            <div class="col-md-6">
                                <input id="birth_date" type="date" value="{{ old('birth_date') }}" class="form-control" name="birth_date" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                <div class="form-check">
                                    <input id="gender-male" type="radio" value="male" name="gender" class="form-check-input" checked>
                                    <label for="gender-male" class="form-check-label">
                                        Male
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input id="gender-female" type="radio" value="female" name="gender" class="form-check-input" >
                                    <label for="gender-female" class="form-check-label">
                                        Female
                                    </label>
                                </div>
                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="facebook" class="col-md-4 col-form-label text-md-right">{{ __('Facebook') }}</label>

                            <div class="col-md-6">
                                <input id="facebook" type="text" value="{{ old('facebook') }}" class="form-control" name="facebook" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                            <div class="col-md-6">
                                <div class="form-check">
                                    <input id="role-customer" type="radio" value="customer" name="role" class="form-check-input" checked>
                                    <label for="role-customer" class="form-check-label">
                                        Customer
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input id="role-owner" type="radio" value="owner" name="role" class="form-check-input" >
                                    <label for="role-owner" class="form-check-label">
                                        Owner
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input id="role-employee" type="radio" value="employee" name="role" class="form-check-input" >
                                    <label for="role-employee" class="form-check-label">
                                        Employee
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row" id="profiler" style="height:auto">
          
                            <label for="profile" class="col-md-4 col-form-label text-md-right">{{ __('Profile') }}</label>

                            <div class="col-md-6" style="height:auto">
                                <div class="custom-file">
                                    <input accept="image/*" v-on:change="onSelectProfileUploadImage($event)" class="custom-file-input" type="file" id="profile" name="profile">
                                    <label class="custom-file-label" for="profile">@{{ profile_upload_filename }}</label>
                                    
                                </div>
                                <img style="max-width:100%;height:auto;margin-top:10px" class="img img-responsive" id="profile-preview" alt="">
                            </div>
                        </div>
                        

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push("js")
    <script src="{{ asset('js/register.js') }}"></script>
@endpush
