@extends('layouts.app')

@section('content')
<div class="container">
  <table class="table">
    <thead class="thead-light">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Shop Name</th>
        <th scope="col">Owner</th>
        <th scope="col">Phone</th>
        <th scope="col">Email</th>
        <th scope="col">Category</th>

      </tr>
    </thead>
    <tbody>
      @foreach($shops as $shop)
      <tr>
        <th scope="row">{{ $shop->id }}</th>
        <td>
          <a href="{{ url('/maitahome/shops/' . $shop->id) }}">
            {{ $shop->name }}
          </a>
        </td>
        <td>{{ $shop->owner->fname }}</td>
        <td>{{ $shop->phone }}</td>
        <td>{{ $shop->email }}</td>
        <td>{{ $shop->category}}</td>


        </tr>
        @endforeach
      </tbody>
</table>
		</div>
@endsection
