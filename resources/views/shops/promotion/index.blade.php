@extends('layouts.app')

@section('content')

    <div class="d-flex flex-column justify-content-end w-75 mx-auto">
        <div class="h3 d-flex justify-content-between card-header font-weight-bold bg-dark text-white">
            <i class="fa fa-shopping-basket" aria-hidden="true"></i>
            {{$shop->name}} All Promotion
            <a href="/shops/{{$shop->id}}/promotion/create" class="btn btn-primary font-weight-bold"> Make Promotion</a>
        </div>

        @foreach($promotions as $promotion)
            <div class="my-2 card border-dark">
                <div class="card-header">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-7 h5 m-0">
                            <a href="/shops/{{$shop->id}}/promotion/{{$promotion->id}}" class="h4 font-weight-bold text-dark" >
                                <i class="fa fa-gift" aria-hidden="true"></i>
                                {{$promotion->reward_name}}
                            </a>
                            <br>
                            <label><i class="fa fa-credit-card-alt" aria-hidden="true"></i> {{$promotion->CardTemplate->name}}</label>
                        </div>
                        <div class="d-flex px-3">
                            <a class="btn btn-success px-3"
                               href="/shops/{{$shop->id}}/promotion/{{$promotion->id}}/edit">edit</a>

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
                        </div>

                    </div>
                </div>


                <div class="card-body">
                    <div class="d-flex justify-content-around">
                        <img src="{{ url('storage/promotions/'.$promotion->reward_img) }}"
                             width="350" height="200" alt="{{ $promotion->reward_img }}">
                    </div>
                    <br>
                    <label class="font-weight-bold">
                        <i class="fa fa-th-list" aria-hidden="true"></i>
                        Condition:
                    </label>
                    <br>
                    <label>{{$promotion->condition}}</label>
                    <br>
                    <label class="font-weight-bold">
                        <i class="fa fa-calendar-times-o" aria-hidden="true"></i>
                        Expiry Date:
                    </label>
                    <label class="h5 font-weight-bold text-danger">{{$promotion->exp_date}}</label>
                </div>

            </div>
        @endforeach
    </div>

@endsection   