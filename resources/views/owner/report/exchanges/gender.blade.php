@extends("layouts.app")

@section("content")
    <div class="container" id="exchange-gender">
        <div class="row">
            <div class="col-xs-12 col-md-8">
                <canvas style="padding:5px;" class="card-body" id="exchangeChart" width="400" max-height="100"></canvas>
            </div>
            <div class="col-xs-12 col-md-4 side-menu" style="height:300px">
                <h4>
                    Select Promotion
                </h4>
                <div class="side-scroll">
                    @foreach($datasets as $dataset)
                    <div class="form-check">
                        <input v-on:change="onCheckPromotion({{$dataset['id']}})" name="promotion" class="form-check-input" type="radio" value="" id="promotion-select-{{$dataset['id']}}">
                        <label 
                        @if(((int) $dataset["available"]) != 1)
                            class='form-check-label exp-promotion'
                        @else
                            class='form-check-label'
                        @endif
                        for="promotion-select-{{$dataset['id']}}">
                            {{ $dataset['name'] }}
                        </label>
                    </div>
                    @endforeach 
                </div>
                
            </div>
        </div>

        <div class="row">
            <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Promotion Name</th>
                    @foreach($label as $gender)
                        <th scope="col">{{$gender}}</th>
                    @endforeach
                    
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($datasets as $dataset)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td><a href='{{ url("shops/$shop_id/promotion/".$dataset["id"]) }}'>{{ $dataset['name'] }}</a></td>
                        <td>{{ $dataset['data']['male'] }}</td>
                        <td>{{ $dataset['data']['female'] }}</td>
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
    <script src="{{ asset('js/owner/reports/exchanges/gender.js') }}"></script>
@endpush
@push("css")
    <link href="{{ asset('css/report.css') }}" rel="stylesheet">
@endpush