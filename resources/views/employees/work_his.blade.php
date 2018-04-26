@extends('layouts.app')

@section('content')

<div class="row">

	<table class="table">
	  <thead>
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Giving To</th>
	      <th scope="col">Point</th>
	      <th scope="col">Giving At</th>

	    </tr>
	  </thead>
	  <tbody>
	    @foreach($works as $work)
	    <tr>
	      <th scope="row">{{ $loop->iteration }}</th>
	      <td>
	        {{ $work->username }}
	      </td>
	      <td>{{ $work->point }}</td>
	      <td>{{ $work->created_at->diffForHumans() }}</td>

	    </tr>
	    @endforeach
	  </tbody>
	</table>
	

</div>

@endsection