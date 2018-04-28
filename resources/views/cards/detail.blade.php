@extends('layouts.app')

@section('content')

    <div class="row m-2">
        <div class="card-header h3 font-weight-bold bg-dark text-white">Card</div>
        <div class="col-lg-5 card m-2 p-0">
            <div class="h2 card-header">
                {{$card->cardTemplate->name}}
                <div class="h5">
                    {{$card->cardTemplate->style}}
                </div>
            </div>
            <div class="card-body d-flex flex-column align-items-center">
                <div class="d-flex justify-content-around">
                    <img src="{{ url('storage/cards/'.$card->CardTemplate->img) }}"
                         width="350" height="200" alt="{{ $card->CardTemplate->img }}">
                </div>

                @if($card->cardTemplate->style === 'point')
                <div>
                    <label class="mt-1"> Checkin Point [ + {{$card->checkin_point}} ]</label>
                </div>
                <div>
                    <div class="input-group my-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text font-weight-bold">Remaining Point : </span>
                        </div>
                        <input disabled class="text-center font-weight-bold bg-white" value="{{$card->point}}">
                    </div>
                </div>

                @else
                <div>
                    <div class="input-group my-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text font-weight-bold ">Stamp : </span>
                        </div>
                        <input disabled class="text-center font-weight-bold  bg-white" value="{{$card->point}}">
                    </div>
                </div>
                @endif

            </div>
            <a href="" class="btn btn-light font-weight-bold w-100">Redeem Point</a>
        </div>


        <div class="col-lg-5 card m-2 p-0">
            <div class="card-header h4 font-weight-light">Shop</div>
            <div class="h2 card-body mb-0">
                {{$card->cardTemplate->shop->name}}
                <div class="h5">
                    {{$card->cardTemplate->shop->category}}
                </div>
            </div>
            <div class="d-flex flex-wrap justify-content-around  align-items-center card-body">
                <div class="">
                    <img src="{{ url('storage/logos/'.$card->CardTemplate->shop->logo_img) }}"
                         width="120" height="120" alt="{{ $card->CardTemplate->shop->logo_img }}">
                </div>
                <div class="h4">
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