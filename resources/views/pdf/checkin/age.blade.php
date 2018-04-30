@extends("layouts.report-pdf")

@section("title")
    Point Available by Age
@endsection

@section("header")
    Check-in Point Available by Age Report
@endsection

@section("for")
    {{ $for }}
@endsection

@section("head")
    <tr>
        <th scope="col">#</th>
        <th scope="col">Template Name</th>
        @foreach($label as $age)
            <th scope="col">{{$age}} years</th>
        @endforeach
        
        </tr>
    </tr>
@endsection

@section("body")
    @foreach($datasets as $dataset)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td><a href='{{ url("/templates/" . $dataset["template_id"]) }}'>{{ $dataset['template_name']}}</a></td>
            @foreach($dataset['data'] as $time)
                <td>{{ $time }}</td>
            @endforeach
        </tr>
    @endforeach
@endsection