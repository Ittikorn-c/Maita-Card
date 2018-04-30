@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card-header"><strong><h4>Your Shops</h4></strong><hr>
    <div class="">
      <a href="/owner/report"><button type="button" name="button" class="btn btn-default">report</button></a>

      <a href="/employees"><button type="button" name="button" class="btn btn-warning">employees</button></a>
      <button type="button" name="button" class="btn btn-success">promotions</button>
    </div>

  </div>
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
