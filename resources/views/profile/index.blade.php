@extends('layouts.app')

@section('content')
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Username</th>
      <th scope="col">First Name</th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $user)
    <tr class='table'>
      <th scope="row">{{ $loop->iteration }}</th>
      <td>
        <a href="{{ url('/profile/' . $user->id) }}">
          {{ $user->username }}
        </a>
      </td>
      <td>{{ $user->fname }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
