@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column justify-content-end w-75 mx-auto">
        <div class="h3 card-header font-weight-bold bg-dark">
            <a href="/shops/{{$shop->id}}/promotion" class="text-white">Promotion</a>
        </div>
        <form>
            <div class="">
                <div class="m-2 card-header">

                    <label class="h5 font-weight-bold">{{ $promotion->reward_name }}</label>
                </div>
                <div class="m-2 card-header bg-light">
                    <label class="font-weight-bold"><ins>Condition</ins></label>
                    <br>
                    <label class="">{{ $promotion->condition }}</label>
                </div>
                <div class="m-2 card-header bg-light">
                    <label class="font-weight-bold"><ins>Reward Image</ins></label>
                    <br>
                    <div class="d-flex justify-content-around">
                        <img src="{{ url('storage/promotions/'.$promotion->reward_img) }}"
                             width="350" height="200" alt="{{ $promotion->reward_img }}">
                    </div>
                </div>
                <div class="d-flex align-items-baseline justify-content-around m-2 card-header">
                    <div>
                        <label class="h5 p-3 font-weight-bold bg-light"><ins>Card</ins> : {{ $promotion->CardTemplate->name }}</label>
                    </div>
                    <div>
                        <label class="h5 p-3 font-weight-bold bg-light"><ins>Point</ins> : {{ $promotion->point }}</label>
                    </div>
                </div>
                <div class="m-2 card-header bg-light text-center">
                    <label class="font-weight-bold">Expiry Date:</label>
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