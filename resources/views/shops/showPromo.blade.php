@extends('layouts.app')

@section('content')
<div class="container">

    <header class="jumbotron my-4">
      <h1 class="display-3">{{$shop->name}}</h1>
      <small>Promotions for you</small>
    </header>

    <div class="row">
      @foreach($promotions as $promotion)
      <div class="col-lg-4 col-sm-6 portfolio-item">
        <div class="card h-100">
          <a href="{{url('/maitahome/' . $promotion->id)}}"><img class="card-img-top" src="http://placehold.it/700x400" alt="{{$promotion->logo_img}}"></a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="{{url('/maitahome/' . $promotion->id)}}">{{$promotion->reward_name}}</a>
            </h4>

            <strong><p class="card-text">Point: {{$promotion->point}}</p></strong>
            <p class="card-text">expired date: {{\Carbon\Carbon::parse($promotion->exp_date)->diffForHumans() }}</p>
          </div>
        </div>
      </div>
      <hr>
      @endforeach

    </div>

  </div>
@endsection

@push('css')
<link href="{{ asset('css/maitahome.css') }}" rel="stylesheet">
@endpush
