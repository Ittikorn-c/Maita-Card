@extends("layouts.app")

@section("content")
    <div class="container" id="exchange-age">
        <div class="row">
            <div class="col-xs-12 col-md-8">
                <canvas style="padding:5px;" class="card-body" id="exchangeChart" width="400" max-height="100"></canvas>
            </div>
            <div class="col-xs-12 col-md-4 side-menu" style="height:300px">
                <h4>
                    Select Promotion
                </h4>
                <div class="side-scroll">
                    @foreach($promotions as $promotion)
                    <div class="form-check">
                        <input v-on:change="onCheckPromotion({{$promotion->id}})" class="form-check-input promotion-checkbox" type="checkbox" value="" id="promotion-select-{{$promotion->id}}">
                        <label 
                        @if(((int) $promotion->available) != 1)
                            class='form-check-label exp-promotion'
                        @else
                            class='form-check-label'
                        @endif
                        for="promotion-select-{{$promotion->id}}">
                            {{ $promotion->reward_name }}
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
                    @foreach($label as $age)
                        <th scope="col">{{$age}} years</th>
                    @endforeach
                    
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($promotions as $promotion)
                    @php($data = $dataset[$promotion->id]["data"])
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $promotion->reward_name }}</td>
                        @foreach($data as $time)
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
        var datasets = JSON.parse('{!! json_encode($dataset) !!}');

    </script>
    <script src="{{ asset('js/report-exchange-age.js') }}"></script>
@endpush
@push("css")
    <link href="{{ asset('css/report.css') }}" rel="stylesheet">
@endpush