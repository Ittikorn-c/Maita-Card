@extends('layouts.app')

@section('content')
        <div class="page-header">
            <h1 style="text-align: center;">{{ $title }} QR<br>
           
            </h1>
        </div>

      <div class="row">
        <div class="col">
            <!-- case cus QR -->
            @if($title === 'My')
            <div style="width: 400px; margin: 0px 150px;">
                <center><img src="{{ asset('storage/profiles/'. $obj->profile_img) }}" alt=""></center>
                <h3><span class="badge badge-secondary">Username</span> {{ $obj->username }}</h3>
                <p>Give this QR to employee for adding your point</p>
            </div>
            <!--  case branch QR -->
            @elseif($title === 'Branch')
                <div style="width: 400px; margin: 0px 150px;">
                    <center><img src="{{ asset('storage/shops/'. $obj->shop->logo_img) }}" alt=""></center>
                    <h3><span class="badge badge-secondary">Shop Name</span> {{ $obj->shop->name }}</h3>
                    <h3><span class="badge badge-secondary">Branch Name</span> {{ $obj->name }}</h3>
                </div>
                <!--  case Reward QR -->
            @else
                <div style="width: 400px; margin: 0px 150px;">
                    <center><img src="{{ asset('storage/promotions/'. $obj->reward_img) }}" alt=""></center>
                    <h3><span class="badge badge-secondary">Reward Name</span> {{ $obj->reward_name }}</h3>
                    <h3><span class="badge badge-secondary">Shop Name</span> {{ $obj->name }}</h3>
                    <h3><span class="badge badge-secondary">Expire</span> {{ \Carbon\Carbon::parse($obj->expire_date)->diffForHumans() }}</h3>
                </div>
            @endif
        </div>
        <div class="col">
            <div id="QR-Code" class="container" style="width:100%">
                <div class="panel-body" align="center">
                    {!! $qr !!}
                </div>
            </div>
        </div>
      </div>

    </div>
@endsection
