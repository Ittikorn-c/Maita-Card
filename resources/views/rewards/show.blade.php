@extends('layouts.app')

@section('content')

<div class="page-header">
    <h1 style="text-align: center;">
    	Rewards
    </h1>
    <a href="/{{ $template_id }}/rewards/myrewardsQR"><button class="btn btn-info" style="position: absolute; right: 10px;">My Rewards QR</button></a>
    <br><br>
</div>

<div class="row">
	@foreach($promos as $promo)

	@if($today < $promo->exp_date)
	    <div class="col-lg-4 col-sm-6 portfolio-item">
	        <div class="card h-100">
	            <a href="{{ url('/' . $template_id . '/rewards' . '/' . $promo->id) }}"><img class="card-img-top" src="{{URL::asset('/images/'. $promo->reward_img)}}" alt=""></a>
	            <div class="card-body">
	              <h4 class="card-title">
	                <a href="{{ url('/' . $template_id . '/rewards' . '/' . $promo->id) }}">{{ $promo->reward_name }}</a>
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