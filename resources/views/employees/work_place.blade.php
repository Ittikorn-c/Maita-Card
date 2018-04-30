@extends('layouts.app')

@section('content')

<div class="page-header">
    <h1 style="text-align: center;">
    	Select Your Work's Branches
    </h1>
    <br><br>
</div>

<div class="row">
	@foreach($branches as $branch)


	    <div class="col-lg-4 col-sm-6 portfolio-item">
	        <div class="card h-100">
	            <a href="{{ url('/' . $branch->branch_id . '/scan') }}"><img class="card-img-top" src="{{ asset('storage/shop/'. $branch->logo_img) }}" alt=""></a>
	            <div class="card-body">
	              <h4 class="card-title">
	              	<!-- show shop name -->
	                <a href="{{ url('/' . $branch->branch_id . '/scan') }}">{{ $branch->name }}</a>
	              </h4>
	              <p>Address: {{ $branch->address }}</p>
	              <!-- <p class="card-text">{{ $branch->condition }}</p> -->
	              {{ 'Contract: ' . $branch->phone }}
	            </div>
	        </div>
	    </div>

    @endforeach

</div>

@endsection