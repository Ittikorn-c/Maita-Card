@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="row card">
            <div class="col-12 card-header">
                <h3>New Card Template</h3>
            </div>
            <div class="col-12 card-body">
                <form class="form-group" action='{{url("/templates")}}' enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group row" id="profiler" style="height:auto">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                        <div class="col-md-6" style="height:auto">
                        <input type="text" class="form-control" id="name" name="name">
                        </div>
                    </div>
                    <div class="form-group row" id="profiler" style="height:auto">
                        <label for="style" class="col-md-4 col-form-label text-md-right">Style</label>
                        <div class="col-md-6" style="height:auto">
                            <select name="style" class="form-control" id="style">
                                @foreach($style as $st)
                                    <option value="{{$st}}">{{$st}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" id="profiler" style="height:auto">
                        <label for="shop" class="col-md-4 col-form-label text-md-right">Shop</label>
                        <div class="col-md-6" style="height:auto">
                            <select name="shop" id="shop" class="form-control">
                                @foreach($shops as $shop)
                                    @if($shop->id === $shop_id)
                                        <option value="{{$shop->id}}" selected>{{$shop->name}}</option>
                                    @else
                                        <option value="{{$shop->id}}">{{$shop->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" id="profiler" style="height:auto">
                        <label for="profile" class="col-md-4 col-form-label text-md-right">Template Image</label>
                        <div class="col-md-6" style="height:auto">
                            <div class="custom-file">
                                <input accept="image/*" v-on:change="onSelectProfileUploadImage($event)" class="custom-file-input" type="file" id="profile" name="img">
                                <label id="profile-label" class="custom-file-label" for="profile">Choose Image ....</label>  
                            </div>
                            <img style="max-width:100%;height:auto;margin-top:10px" class="img img-responsive" id="profile-preview" alt="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12" style="text-align:center">
                            <button style="margin:0 auto" class="btn btn-success">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('js/shops/create.js') }}" defer></script>
@endpush