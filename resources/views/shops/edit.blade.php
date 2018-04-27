@extends('layouts.app')

@section('content')
<div class="container">
  <div class="jumbotron">
    <h1>Edit Shop</h1>
  </div>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">edit</div>
        <div class="card-body">
          <form class="" action="/maitahome/shops/{{$shop->id}}" method="post">
            @csrf
            @method("PUT")
            <div class="form-group row">
              <label for="" class="col-sm-4 col-form-label text-md-center"><i class="fa fa-user-circle">   Owner</i> </label>
              <div class="col-md-4">
                  <p>{{$shop->owner->fname}}  {{$shop->owner->lname}}</p>
              </div>

            </div>
            <div class="form-group row">
              <label for="" class="col-sm-4 col-form-label text-md-center"><i class="fa fa-address-book"></i>   Shop Name</label>
              <div class="col-md-6">
              <input type="text"  class="form-control" placeholder="shop name.." name="shopname" value="{{old('shopname') ?? $shop->name}}">
              </div>

            </div>

            <div class="form-group row">
              <label for="" class="col-sm-4 col-form-label text-md-center"><i class="fa fa-phone"></i>   Phone</label>
              <div class="col-md-6">
                <input type="text"  class="form-control" placeholder="phone number.." name="shopphone" value="{{old('shopphone') ?? $shop->phone}}">
              </div>

            </div>
            <div class="form-group row">
              <label for="" class="col-sm-4 col-form-label text-md-center"><i class="fa fa-envelope"></i>   Email</label>
              <div class="col-md-6">
                  <input type="email"  class="form-control" placeholder="" name="shopphone" value="{{old('shopemail') ?? $shop->email}}">
              </div>

            </div>
            <div class="form-group row">
              <label for="" class="col-sm-4 col-form-label text-md-center"><i class="fa fa-server"></i>   Category</label>
              <div class="col-md-6">
                  <input type="text"  class="form-control" placeholder="phone number.." name="shopphone" value="{{old('shopcategory') ?? $shop->category}}">
              </div>

            </div>
            <div class="form-group row">
              <label for="" class="col-sm-4 col-form-label text-md-center"><i class="fa fa-desktop"></i>    Shop logo</label>
              <div class="col-md-6">
                <div class="custom-file">
                    <input v-on:change="onSelectProfileUploadImage($event)" class="custom-file-input" type="file" id="profile" name="shoplogo">
                    <label class="custom-file-label" for="shoplogo">Choose file</label>

                </div>

                <img style="max-width:100%;height:auto;margin-top:10px" class="img img-responsive" id="profile-preview" alt="">
              </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </div>
            </div>



        </div>
      </div>
    </div>



  </div>

</div>
@endsection
