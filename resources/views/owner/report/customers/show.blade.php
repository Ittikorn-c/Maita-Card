@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="row card">
            <div class="col-12 card-header">
                <h4>{{ $customer->name }}</h4>
            </div>
            <div class="row">
                <div class="col-4">
                    <img src='{{ asset("storage/profile/$customer->profile_img") }}' alt="">
                </div>
                <div class="col-8" style="padding-top:16px">
                    <table class="table table-borderless" border="0">
                        
                        <tr >
                            <td>Name :</td>
                            <td> {{ $customer->name }} </td>
                        </tr>
                        <tr style="border:none">
                            <td>Gender</td>
                            <td> {{ $customer->age() }} </td>
                        </tr>
                        <tr>
                            <td>Age</td>
                            <td>{{ $customer->age() }}</td>
                        </tr>
                        <tr>
                            <td>Birth Date</td>
                            <td>{{ \Carbon\Carbon::parse($customer->birth_date)->format("d/m/Y") }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $customer->email }} </td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>{{ $customer->address }}</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>{{ $customer->phone }}</td>
                        </tr>
                        <tr>
                            <td>Facebook</td>
                            <td>{{ $customer->facebook }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            
        </div>
        @foreach($customer->shop_card as $card)
            <div class="row card" style="margin-top:16px">
                <div class="col-12 card-header">
                <h5>{{  $card->cardTemplate->name}}</h5>
                </div>
                <div class="row card-body">
                    <div class="col-4">
                        <img src='' alt="">
                    </div>
                    <div class="col-8">
                        Point : {{ $card->point }} <br>
                        Checkin point : {{ $card->checkin_point }}
                    </div>
                    <div class="col-12">
                        <a class="btn btn-primary dropdown-toggle" data-toggle="collapse" href="#collapse-{{$card->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Exchange
                        </a>
                        <div class="collapse" id="collapse-{{$card->id}}">
                        <div class="card card-body">
                            <table>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Reward</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($card->rewardHistories as $exchange)
                                        <tr>
                                            <th>{{$loop->iteration}}</th>
                                            <td>{{ $exchange->promotion->reward_name}}</td>
                                            <td>{{ \Carbon\Carbon::parse($exchange->updated_at)->format("d/m/Y") }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                        </div>
                    </div>
                </div>
                
            </div>
        @endforeach
        
    </div>
@endsection