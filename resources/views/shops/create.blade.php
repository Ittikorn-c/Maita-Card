@extends('layouts.app')

@section('content')

<div class="container">
  <div class="jumbotron">
    <h1>Create New Shop</h1>
  </div>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">create</div>
        <div class="card-body">
          <form class="" action="/maitahome/shops" method="post">
            @csrf
            <div class="form-group row">
              <label for="" class="col-sm-4 col-form-label text-md-right"><i class="fa fa-user-circle"></i> Owner</label>
              <div class="col-md-6">
                  <p>someone</p>
              </div>

            </div>
            <div class="form-group row">
              <label for="" class="col-sm-4 col-form-label text-md-right"><i class="fa fa-address-book"></i>Shop Name</label>
              <div class="col-md-6">
                  <input type="text"  class="form-control" placeholder="shop name.." name="shopname" value="">
              </div>

            </div>

            <div class="form-group row">
              <label for="" class="col-sm-4 col-form-label text-md-right"><i class="fa fa-phone"></i> Phone</label>
              <div class="col-md-6">
                  <input type="text"  class="form-control" placeholder="phone number.." name="shopphone" value="">
              </div>

            </div>
            <div class="form-group row">
              <label for="" class="col-sm-4 col-form-label text-md-right"><i class="fa fa-envelope"></i> Email</label>
              <div class="col-md-6">
                  <input type="email"  class="form-control" placeholder="email.." name="shopemail" value="">
              </div>

            </div>
            <div class="form-group row">
              <label for="" class="col-sm-4 col-form-label text-md-right"><i class="fa fa-server"></i> Category</label>
              <div class="col-md-6">
                  <select class="form-control" name="shopcategory">
                    @foreach($categories as $category)
                    <option value="{{$category}}" class="form-control">{{$category}}</option>
                    @endforeach
                  </select>
              </div>

            </div>
            <div class="form-group row">
              <label for="" class="col-sm-4 col-form-label text-md-right"><i class="fa fa-desktop"></i>Shop logo</label>
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


          </form>
        </div>
      </div>
    </div>



  </div>




</div>
@endsection
