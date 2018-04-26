@extends('layouts.app')

@section('content')

<div class="row">
	@foreach($promos as $promo)

	@if($today < $promo->exp_date)
	    <div class="col-lg-4 col-sm-6 portfolio-item">
	        <div class="card h-100">
	            <a href="#"><img class="card-img-top" src="{{URL::asset('/images/'. $promo->reward_img)}}" alt=""></a>
	            <div class="card-body">
	              <h4 class="card-title">
	                <a href="#">{{ $promo->reward_name }}</a>
	              </h4>
	              <h5>Point: {{ $promo->point }}</h5>
	              <p class="card-text">{{ $promo->condition }}</p>
	              {{ 'Expire: ' . \Carbon\Carbon::parse($promo->exp_date)->diffForHumans() }}
	            </div>
	        </div>
	    </div>
	@endif
    @endforeach

</div>

@endsection