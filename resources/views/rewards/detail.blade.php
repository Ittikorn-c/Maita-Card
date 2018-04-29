@extends('layouts.app')

@section('content')

<div class="page-header">
    <h1 style="text-align: center;">Redemption Point<br>
           
    </h1>
</div>

<div class="panel panel-default">
    <div class="panel-heading" align="center">
    	<img src="{{URL::asset('/images/'. $promo->reward_img)}}" alt="">
    	<br>
        <h2>{{ $promo->reward_name }}</h2>
    </div>
    <ul class="list-group">
      
      <li class="list-group-item">This Reward Exchange Point: {{ $promo->point }}

      </li>

      <li class="list-group-item">Condition: {{ $promo->condition }}</li>
      <li class="list-group-item">Your Current Point: {{ $card->point }}</li>

      <li class="list-group-item">
        Expire Date: {{ \Carbon\Carbon::parse($promo->exp_date)->diffForHumans() }}
      </li>
    </ul>
    <br>
    <center>
    	<div class="panel-footer">

	      <form action="{{ url('/' . $card->template_id . '/rewards' . '/' . $promo->id) }}" method="post">
	          @csrf

	          <input hidden="true" type="number" name="card_id" value="{{ $card->id }}">
	          <input hidden="true" type="number" name="promotion_id" value="{{ $promo->id }}">

	          <button type="submit" class="btn btn-primary">Redemption Point</button>
	      </form>      
	    </div>
	</center>
</div>

@endsection