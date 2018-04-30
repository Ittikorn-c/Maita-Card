@extends("layouts.app")



@section("content")
    <div class="container" id="report">
        <div class="row">
            <div class="col-12">
                <div class="select-shop" style="float:right">
                    <h5 style="display:inline; margin-right:10px">Shop</h5>
                    <div class="dropdown show" style="display:inline">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ $shop->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            @foreach($shops as $sh)
                                <a class="dropdown-item" href='{{ url("owner/report/$sh->id") }}'> {{ $sh->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-xs-12 col-md-4">
                <a href='{{ url("/owner/report/customers/$shop->id") }}' id="total-customer" class="card top-block">
                    <h5>Total Customer</h5>
                    <h1>{{ $totalCustomer }}</h1>
                </a>
            </div>
            <div class="col-xs-12 col-md-4">
                <div id="total-card" class="card top-block">
                    <h5>Total Card</h5>
                    <h1>{{ $totalCard }}</h1>
                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                <div id="total-exchange" class="card top-block">
                    <h5>Total Exchange</h5>
                    <h1>{{ $totalExchange }}</h1>
                </div>
            </div>
        </div>

        <h4><b>Exchange Rate</b></h4>
        <hr>
        <div class="row chart-group">
            <div class="col-8">
                <div class="card">
                    <h5 id="exchange" class="card-header">Exchange Rate</h5>
                    <canvas class="card-body" id="exchangeChart" width="400" max-height="100"></canvas>
                    <p style="text-align:center">
                        Exchange Rate per promotion
                    </p>
                    
                </div>
            </div>
            <div class="col-4 side-container">
                <a id="exchange-promotion" href='{{ url("/owner/report/exchange/promotion/$shop->id") }}' class="card simple-block" style="flex-grow:1">
                    <p>
                        EXCHANGE <br>
                        PROMOTION
                    </p>
                </a>
                <a id="exchange-age" href='{{ url("/owner/report/exchange/age/$shop->id") }}' class="card simple-block" style="flex-grow:1">
                    <p>
                        EXCHANGE <br>
                        AGE
                    </p>
                </a>
                <a id="exchange-gender" href='{{ url("/owner/report/exchange/gender/$shop->id") }}' class="card simple-block" style="flex-grow:1">
                    <p>
                        EXCHANGE <br>
                        GENDER
                    </p>
                </a>
            </div>
        </div>
        
        <h4><b>Point Receive</b></h4>
        <hr>
        <div class="row chart-group">
            <div class="col-4 side-container">
                <a id="point-receive-time" href='{{ url("/owner/report/pointReceive/time/$shop->id") }}' class="card simple-block" style="flex-grow:1">
                    <p>
                        POINT RECEIVE <br>
                        TIME
                    </p>
                </a>
                <a id="point-receive-age" href='{{ url("/owner/report/pointReceive/age/$shop->id") }}' class="card simple-block" style="flex-grow:1">
                    <p>
                        POINT RECEIVE <br>
                        AGE
                    </p>
                </a>
                <a id="point-receive-gender" href='{{ url("/owner/report/pointReceive/gender/$shop->id") }}' class="card simple-block" style="flex-grow:1">
                    <p>
                        POINT RECEIVE <br>
                        GENDER
                    </p>
                </a>
            </div>
            <div class="col-8">
                <div class="card">
                    <h5 id="point-receive" class="card-header">Point Receive</h5>
                    <canvas class="card-body" id="pointReceiveChart" width="400" max-height="400"></canvas>
                    <p style="text-align:center">
                        Total point receive by time
                    </p>
                    
                </div>
            </div>
        </div>
        <h4><b>Point Available</b></h4>
        <hr>
        <div class="row chart-group">
            <div class="col-8">
                <div class="card">
                    <h5 id="point-available" class="card-header">Point Available</h5>
                    <canvas class="card-body" id="pointAvailableChart" width="400" max-height="100"></canvas>
                    <p style="text-align:center">
                        Point Available on card by user age
                    </p>
                    
                </div>
            </div>
            <div class="col-4 side-container">
                <a id="point-available-age" href='{{ url("/owner/report/pointAvailable/age/$shop->id") }}' class="card simple-block" style="flex-grow:1">
                    <p>
                        POINT AVAILABLE <br>
                        AGE
                    </p>
                </a>
                <a id="point-available-gender" href='{{ url("/owner/report/pointAvailable/gender/$shop->id") }}' class="card simple-block" style="flex-grow:1">
                    <p>
                        POINT AVAILABLE <br>
                        GENDER
                    </p>
                </a>
                <a id="checkin-point-available-age" href='{{ url("/owner/report/pointAvailable/checkin/age/$shop->id") }}' class="card simple-block" style="flex-grow:1">
                    <p>
                        CHECK-IN POINT AVAILABLE <br>
                        AGE
                    </p>
                </a>
                <a id="checkin-point-available-gender" href='{{ url("/owner/report/pointAvailable/checkin/gender/$shop->id") }}' class="card simple-block" style="flex-grow:1">
                    <p>
                        CHECK-IN POINT AVAILABLE <br>
                        GENDER
                    </p>
                </a>
            </div>
        </div>
    </div>
@endsection

@push("js")
    <script>
        var exchangeData = JSON.parse('{!! json_encode($exchangeData) !!}');
        var pointReceiveData = JSON.parse('{!! json_encode($pointReceiveData) !!}');
        var pointAvailableBundle = JSON.parse('{!! json_encode($pointAvailableData) !!}');
    </script>
    <script src="{{ asset('js/owner/reports/home.js') }}"></script>
@endpush
@push("css")
    <link href="{{ asset('css/report.css') }}" rel="stylesheet">
@endpush