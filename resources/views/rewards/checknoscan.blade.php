@extends('layouts.app')

@section('content')

<div class="row">

	<table class="table">
	  <thead>
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Reward Name</th>
	      <th scope="col">Shop Name</th>
	      <th scope="col">Redemp At</th>

	    </tr>
	  </thead>
	  <tbody>
	    @foreach($rewards as $reward)
	    <tr>
	      <th scope="row">{{ $loop->iteration }}</th>
	      <td>
	        <a href="/{{ $reward->reward_code }}/qr-code/Rewards">{{ $reward->reward_name }}</a>
	      </td>
	      <td>{{ $reward->name }}</td>
	      <td>{{ $reward->created_at->diffForHumans() }}</td>

	    </tr>
	    @endforeach
	  </tbody>
	</table>
	

</div>

@endsection