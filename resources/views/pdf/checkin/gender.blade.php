@extends("layouts.report-pdf")

@section("title")
    Point Available by Age
@endsection

@section("header")
    Check-in Point Avaialable by Gender Report
@endsection

@section("for")
    {{ $for }}
@endsection

@section("head")
    <tr>
        <th scope="col">#</th>
        <th scope="col">Template Name</th>
        @foreach($label as $gender)
            <th scope="col">{{$gender}}</th>
        @endforeach
        
    </tr>
@endsection

@section("body")
    @foreach($datasets as $dataset)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td><a href='{{ url("/templates/" . $dataset["template_id"]) }}'>{{ $dataset['template_name'] }}</a></td>
            <td>{{ $dataset['data']['male'] }}</td>
            <td>{{ $dataset['data']['female'] }}</td>
        </tr>
    @endforeach
@endsection