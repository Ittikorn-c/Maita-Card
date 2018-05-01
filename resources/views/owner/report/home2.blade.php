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