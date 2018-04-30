@extends('layouts.app')

@section('content')
@if(Auth::user()->role === 'owner')
<h1 style="text-align: center;">
      My Employees
</h1>

<a href="/employees/job-applied"><button class="btn btn-info" style="position: absolute; right: 10px;">Job Applied</button></a>
<br><br><br>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Username</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Shop Name</th>
      <th scope="col">Branch Name</th>
    </tr>
  </thead>
  <tbody>
    
    @foreach($employees as $employee)
    @if(Auth::user()->id === $employee->branch->shop->owner_id)
    <tr class='table'>
      <th scope="row">{{ $loop->iteration }}</th>
      <td>
        <a href="{{ url('/profile/' . $employee->user_id) }}">
          {{ $employee->user->username }}
        </a>
      </td>
      <td>{{ $employee->user->fname }}</td>
      <td>{{ $employee->user->lname }}</td>
      <td>{{ $employee->user->email }}</td>
      <td>{{ $employee->user->phone }}</td>
      <td>{{ $employee->branch->shop->name }}</td>
      <td>{{ $employee->branch->name }}</td>
    </tr>
    @endif
    @endforeach
  </tbody>
</table>
@else
        <div class="container panel panel-default card">
            <h1>You are not owner</h1>
            <a class="btn btn-danger" href="/profile/{{ Auth::user()->id }}">My profile</a>
        </div>
@endif
@endsection
