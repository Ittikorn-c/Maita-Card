@extends('layouts.app')

@section('content')

    <div class="d-flex flex-column justify-content-end w-75 mx-auto">
        <div class="h3 card-header font-weight-bold bg-dark text-white">
            {{$shop->name}} All Promotion
        </div>

        @foreach($promotions as $promotion)
            <div class="my-2 card border-dark">
                <div class="card-header">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-7 h5 m-0">
                            <label>{{$promotion->reward_name}}</label>
                            <br>
                            <label>{{$promotion->CardTemplate->name}}</label>
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
                    <label>[{{$promotion->reward_img}}]</label>
                    <br>
                    <label>Condition:</label>
                    <label>{{$promotion->condition}}</label>
                </div>

            </div>
        @endforeach
    </div>

@endsection   