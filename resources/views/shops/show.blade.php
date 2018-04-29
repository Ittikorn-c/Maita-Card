@extends('layouts.app')

@section('content')

<div class="container">
  <div class="jumbotron">
    <h1>Shop Detail</h1>
  </div>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">detail</div>
        <div class="card-body">
          <form class="" action="/maitahome/shops/{{$shop->id}}" method="post">
            @csrf
            <div class="form-group row">
              <label for="" class="col-sm-4 col-form-label text-md-center"><i class="fa fa-user-circle">   Owner</i> </label>
              <div class="col-md-4">
                  <p>{{$shop->owner->fname}}  {{$shop->owner->lname}}</p>
              </div>

            </div>
            <div class="form-group row">
              <label for="" class="col-sm-4 col-form-label text-md-center"><i class="fa fa-address-book"></i>   Shop Name</label>
              <div class="col-md-6">
                <p>{{$shop->name}}</p>
              </div>

            </div>

            <div class="form-group row">
              <label for="" class="col-sm-4 col-form-label text-md-center"><i class="fa fa-phone"></i>   Phone</label>
              <div class="col-md-6">
                <p>{{$shop->phone}}</p>
              </div>

            </div>
            <div class="form-group row">
              <label for="" class="col-sm-4 col-form-label text-md-center"><i class="fa fa-envelope"></i>   Email</label>
              <div class="col-md-6">
                <p>{{$shop->email}}</p>
              </div>

            </div>
            <div class="form-group row">
              <label for="" class="col-sm-4 col-form-label text-md-center"><i class="fa fa-server"></i>   Category</label>
              <div class="col-md-6">
                <p>{{$shop->category}}</p>
              </div>

            </div>
            <div class="form-group row">
              <label for="" class="col-sm-4 col-form-label text-md-center"><i class="fa fa-desktop"></i>    Shop logo</label>
              <div class="col-md-6">


                <img src='{{ asset("/storage/shop/$shop->logo_img")}}' style="max-width:100%;height:auto;margin-top:10px" class="img img-responsive" id="profile-preview" alt="">
              </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">

                  <a href="{{url('/maitahome/shops/'. $shop->id . '/edit')}}"><button type="button" name="button" class="btn btn-default">Edit</button>       </a>

                  <form class="" action="/maitahome/shops/{{ $shop->id }}" method="post">
                    @csrf
                    @method("DELETE")
                      <button class="btn btn-danger" type="submit">Delete</button>
                  </form>
                </div>

            </div>




        </div>
      </div>
    </div>



  </div>




</div>
@endsection

@push('js')
  <script type="text/javascript" src="{{asset('js/shops/del.js') }}"></script>
@endpush
