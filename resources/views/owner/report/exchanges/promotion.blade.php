@extends("layouts.app")

@section("content")
    <div class="container" id="exchange-promotion">
        <div class="row">
            <div class="col-xs-12 col-md-8">
                <canvas style="padding:5px;" class="card-body" id="exchangeChart" width="400" max-height="100"></canvas>
            </div>
            <div class="col-xs-12 col-md-4 side-menu" style="height:300px">
                <h4>
                    Select Promotion
                </h4>
                <div class="side-scroll">
                    @foreach($bundle["label"] as $index => $label)
                    <div class="form-check">
                        <input v-on:change="onCheckPromotion({{$index}})" class="form-check-input" type="checkbox" value="" id="promotion-select-{{$index}}" 
                        @if($bundle["available"][$index] == 1)
                            {{ "checked" }}
                        @endif
                        >
                        <label 
                        @if($bundle["available"][$index] != 1)
                            class='form-check-label exp-promotion'
                        @else
                            class='form-check-label'
                        @endif
                        for="promotion-select-{{$index}}">
                            {{ $label }}
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
                    <th scope="col">Expired Date</th>
                    <th scope="col">Exchange Times</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i = 1)
                    @foreach($promotions as $promotion)
                    <tr>
                        <th scope="row">{{ $i++ }}</th>
                        <td>{{ $promotion->reward_name }}</td>
                        <td>{{ $promotion->exp_date }}</td>
                        <td>{{ $promotion->rewardHistories()->count() }}</td>
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
        var bundle = JSON.parse('{!! json_encode($bundle) !!}');
        console.log("bundle", bundle);
    </script>
    <script src="{{ asset('js/owner/reports/exchanges/promotion.js') }}"></script>
@endpush
@push("css")
    <link href="{{ asset('css/report.css') }}" rel="stylesheet">
@endpush