@extends('layouts.app')

@section('content')

    <div class="row m-2">
        <div class="card-header h3 font-weight-bold">Card</div>
        <div class="col-sm-5 card m-2 p-0">
            <div class="h2 card-header">
                {{$card->cardTemplate->name}}
                <div class="h5">
                    {{$card->cardTemplate->style}}
                </div>
            </div>
            <div class="card-body">
                <div class="">
                    <img src="" alt="[image here]">
                </div>
                @if($card->cardTemplate->style === 'point')
                <label class="mt-1"> Checkin Point [ + {{$card->checkin_point}} ]</label>
                <div class="input-group my-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Remaining Point : </span>
                    </div>
                    <input disabled class="text-center font-weight-bold" value="{{$card->point}}">
                </div>
                @else
                <label class="mt-1"> Stamp mode *</label>
                <div class="input-group my-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Stamp : </span>
                    </div>
                    <input disabled class="text-center font-weight-bold" value="{{$card->point}}">
                </div>
                @endif

            </div>
        </div>


        <div class="col-sm-5 card m-2 p-0">
            <div class="card-header h4 font-weight-light">Shop</div>
            <div class="h2 card-body mb-0">
                {{$card->cardTemplate->shop->name}}
                <div class="h5">
                    {{$card->cardTemplate->shop->category}}
                </div>
            </div>
            <div class="row card-body">
                <div class="col-4">
                    [logo here]
                </div>
                <div class="col-8">
                    <label class="">
                        {{$card->cardTemplate->shop->owner->fname .' '. $card->cardTemplate->shop->owner->lname}}
                    </label>
                    <br>
                    <label class="">
                        {{'# '.$card->cardTemplate->shop->phone}}
                    </label>
                    <br>
                    <label class="">
                        {{$card->cardTemplate->shop->email}}
                    </label>
                </div>


            </div>
        </div>

    </div>
@endsection