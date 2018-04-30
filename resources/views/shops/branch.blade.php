@extends('layouts.app')

@section('content')

<div class="page-header">
    <h1 style="text-align: center;">
    	Select The Branches You Want
    </h1>
    <br><br>
</div>

<div class="row">
	@foreach($branches as $branch)


	    <div class="col-lg-4 col-sm-6 portfolio-item">
	    	<form action="/{{ $branch->id }}/job-apply" method="post">
				@csrf
				<!-- CSRF Cross-Site Request Forgery -->
				{{ csrf_field() }}
				
		        <div class="card h-100">
		            <img class="card-img-top" src="{{URL::asset('/images/'. $branch->logo_img)}}" alt="">
		            <div class="card-body">
		              <h4 class="card-title">
		              	<input hidden="true" type="number" name="bid" value="{{ $branch->id }}">
		                <h2>{{ $branch->name }}</h2>
		              </h4>
		              <p>Address: {{ $branch->address }}</p>
		              <!-- <p class="card-text">{{ $branch->condition }}</p> -->
		              {{ 'Contract: ' . $branch->phone }}
		            </div>
		        </div>
		        <center><button class="btn btn-primary" type="submit">Apply</button></center>	    		
	    	</form>

	    </div>

    @endforeach

</div>

@endsection