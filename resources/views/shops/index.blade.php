@extends('layouts.app')

@section('content')
<div class="container">


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
