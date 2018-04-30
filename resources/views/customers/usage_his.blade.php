@extends('layouts.app')

@section('content')

<div class="card-header h3 font-weight-bold bg-dark text-white">
    My Usage History
</div>

<div class="row">

	<table class="table">
	  <thead>
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Shop's Name</th>
	      <th scope="col">Branch's Name</th>
	      <th scope="col">Point</th>
	      <th scope="col">Used At</th>

	    </tr>
	  </thead>
	  <tbody>
	    @foreach($uses as $use)
	    <tr>
	      <th scope="row">{{ $loop->iteration }}</th>
	      <td>
	        {{ $use->name }}
	      </td>
	      <td> {{ $use->branch_name }}</td>	      
	      <td>{{ $use->point }}</td>
	      <td>{{ $use->created_at->diffForHumans() }}</td>

	    </tr>
	    @endforeach
	  </tbody>
	</table>
	

</div>

@endsection