@extends('layouts.app')

@section('content')
    edit promotion
    <form class=""
          action="/shops/{{$shop->id}}/promotion/{{$promotion->id}}"
          method="post">
        @method('PUT')
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


    </form>
@endsection   