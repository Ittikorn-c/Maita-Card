@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="row card">
            <div class="col-12 card-header">
                <h3>{{ $template->name }}</h3>
            </div>
            <div class="row card-body">
                <div class="col-4">
                    <img class="img-fluid" src='{{url("/storage/cards/$template->img") }}' alt="">
                </div>
                <div class="col-8">
                    <p>
                        Style : {{ $template->style }} <br>
                        Create Date : {{ \Carbon\Carbon::parse($template->created_at)->format("j F Y")}}
                    </p>
                </div>
                <div class="col-12" style="margin-top:16px">
                    <a href='{{ url("/templates/edit/$template->id") }}'>
                        <button class="btn btn-primary">
                            Edit
                        </button>
                    </a>
                    <form style="display:inline-block" action='{{url("/templates/$template->id")}}' method="post">
                        @method("DELETE")
                        @csrf
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection