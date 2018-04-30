@extends("layouts.app")

@section("content")
    <div class="container" id="pointReceive-age">
        <div class="row">
            <div class="col-xs-12 col-md-8">
                <canvas style="padding:5px;" class="card-body" id="pointReceiveChart" width="400" max-height="100"></canvas>
            </div>
            <div class="col-xs-12 col-md-4 side-menu" style="height:300px">
                <h4>
                    Select Card Template
                </h4>
                <div class="side-scroll">
                    @foreach($datasets as $dataset)
                    <div class="form-check">
                        <input v-on:change="onCheckPromotion({{$dataset['template_id']}})" class="form-check-input promotion-checkbox" type="checkbox" value="" id="template-select-{{$dataset['template_id']}}" checked>
                        <label class='form-check-label'for="pointReceive-select-{{$dataset['template_id']}}">
                            {{ $dataset['template_name'] }}
                        </label>
                    </div>
                    @endforeach 
                </div>
                
            </div>
            <div class="col-12"style="flex-grow:0.3">
                <a href='{{ url("owner/export/pointReceive/age/$shop_id")}}'>
                <button style="float:right" class="btn btn-outline-warning">Export PDF</button>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Template Name</th>
                    @foreach($label as $age)
                        <th scope="col">{{$age}} years</th>
                    @endforeach
                    
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($datasets as $dataset)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td><a href='{{ url("/templates/" . $dataset["template_id"]) }}'>{{ $dataset['template_name']}}</a></td>
                        @foreach($dataset['data'] as $time)
                            <td>{{ $time }}</td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push("js")
    <script>
        var label = JSON.parse('{!! json_encode($label) !!}');
        var datasets = JSON.parse('{!! json_encode($datasets) !!}');

    </script>
    <script src="{{ asset('js/owner/reports/pointReceive/age.js') }}"></script>
@endpush
@push("css")
    <link href="{{ asset('css/report.css') }}" rel="stylesheet">
@endpush