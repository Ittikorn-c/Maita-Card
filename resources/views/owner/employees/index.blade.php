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
    @foreach($employees as $employee)
    <tr class='table'>
      <th scope="row">{{ $loop->iteration }}</th>
      <td>
        <a href="{{ url('/profile/' . $employee->user_id) }}">
          {{ $employee->username }}
        </a>
      </td>
      <td>{{ $employee->fname }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
