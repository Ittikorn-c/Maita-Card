@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>Join Card for {{$shop->name}}</h3>
            </div>
            <div class="col-12">
                @foreach($templates as $template)
                    <div class="card">
                    <div class="row card-body">
                        <div class="col-4">
                            <img class="img-fluid" src='{{ url("storage/cards/$template->img") }}' alt="">
                        </div>
                        <div class="col-6">
                            <h5>{{ $template->name }}</h5>
                            <form action="/joinCard/card" method="post">
                                @csrf
                                <input type="text" value="{{$template->id}}" name="template_id" hidden>
                                <button type="submit" class="btn btn-primary">Join</button>
                            </form>
                        </div>
                    </div>
                    </div>
                    
                @endforeach
            </div>
        </div>
    </div>
@endsection