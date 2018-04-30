@extends('layouts.app')

@section('content')
<div class="container">
    <div class="h3 mb-4 card-header font-weight-bold bg-dark text-white">
        Shop
    </div>
    @if(count($shops) === 0)
        <div class="h4 text-center">
            No Content Available
        </div>
    @endif

    @foreach($shops as $shop)
      <div class="row">
        <div class="col-md-7">
          <a href="#">
            <img class="img-fluid rounded mb-3 mb-md-0" src="http://placehold.it/700x300" alt="">
          </a>
        </div>
        <div class="col-md-5">
        <h3 >{{$shop->name}}</h3>
          <small >{{$shop->category}}</small>
          <p><i class="fa fa-phone-square"></i>      {{$shop->phone}}</p>
          <p><i class="fa fa-envelope"></i>      {{$shop->email}}</p>
          <a class="btn btn-primary" href="{{url('/maitahome/shops/' . $shop->id. '/promotions')}}">View Promotion</a> 
          <br>
          @if(Auth::check())
            @if(Auth::user()->role === "customer")
              <a style="margin-top:10px" class="btn btn-success" href='{{ url("/joinCard/$shop->id") }}'>Join Card</a>
            @endif
            @if(Auth::user()->role === "employee")
              <a style="margin-top:10px" class="btn btn-success" href='{{ url("/$shop->id/branches") }}'>Join work</a>
            @endif
          @endif
        </div>
      </div>
      <!-- /.row -->

      <hr>
      @endforeach

    </div>
@endsection
@push('css')
<link href="{{ asset('css/maitahome.css') }}" rel="stylesheet">
@endpush
