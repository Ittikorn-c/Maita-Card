@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-12" style="text-align:center">
                <h2>{{ $shop->name }} - Card Templates</h2>
                
            </div>
            <div class="col-12" style="margin:10px 0; text-align:right">
                <a href='{{ url("/templates/create/$shop->id") }}'>
                    <button class="btn btn-success">New</button>
                </a>
            </div>
            <div class="col-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Template Name</th>
                        <th scope="col">Style</th>
                        <th scope="col">Create Date</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($templates as $template)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td><a href='{{ url("/templates/$template->id") }}'>{{ $template->name }}</a></td>
                                <td>{{ $template->style }}</td>
                                <td>{{ \Carbon\Carbon::parse($template->created_at)->format("j F Y")}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection