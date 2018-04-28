@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column justify-content-end w-75 mx-auto">
        <div class="h3 card-header font-weight-bold bg-dark">
            <a href="/shops/{{$shop->id}}/promotion" class="text-white">Promotion</a>
        </div>
        <form>
            <div class="">
                <div class="m-2 card-header">
                    <i class="fa fa-gift" aria-hidden="true"></i>
                    <label class="h5 font-weight-bold">{{ $promotion->reward_name }}</label>
                </div>
                <div class="m-2 card-header bg-light">
                    <i class="fa fa-th-list" aria-hidden="true"></i>
                    <label class="font-weight-bold">Condition</label>
                    <br>
                    <label class="">{{ $promotion->condition }}</label>
                </div>
                <div class="m-2 card-header bg-light">
                    <i class="fa fa-picture-o" aria-hidden="true"></i>
                    <label class="font-weight-bold">Reward Image</label>
                    <br>
                    <div class="d-flex justify-content-around">
                        <img src="{{ url('storage/promotions/'.$promotion->reward_img) }}"
                             width="350" height="200" alt="{{ $promotion->reward_img }}">
                    </div>
                </div>
                <div class="d-flex align-items-baseline justify-content-around m-2 card-header">
                    <div>
                        <label class="h5 p-3 font-weight-bold bg-light">
                            <i class="fa fa-credit-card-alt" aria-hidden="true"></i>
                            Card : {{ $promotion->CardTemplate->name }}
                        </label>
                    </div>
                    <div>
                        <label class="h5 p-3 font-weight-bold bg-light">
                            <i class="fa fa-product-hunt" aria-hidden="true"></i>
                            Point : {{ $promotion->point }}
                        </label>
                    </div>
                </div>
                <div class="m-2 card-header bg-light text-center">
                    <label class="font-weight-bold">
                        <i class="fa fa-calendar-times-o" aria-hidden="true"></i>
                        Expiry Date:
                    </label>
                    <label class="h5 font-weight-bold text-danger">{{$promotion->exp_date}}</label>
                </div>
            </div>


        </form>
        <div class="px-3 d-flex flex-row-reverse ">
            <form   class=""
                    action="/shops/{{$shop->id}}/promotion/{{$promotion->id}}" method="post">
                @csrf
                @method("DELETE")
                <button class="btn btn-danger" type="submit" onclick="doubleCheck()">delete</button>
            </form>
            <script>
                function doubleCheck() {
                    if (confirm("Want to Delete?")) {
                        return true;
                    }
                    else {
                        event.preventDefault();
                        return false;
                    }
                }
            </script>

            <a class="btn btn-success px-3"
               href="/shops/{{$shop->id}}/promotion/{{$promotion->id}}/edit">edit</a>
        </div>
    </div>
@endsection   