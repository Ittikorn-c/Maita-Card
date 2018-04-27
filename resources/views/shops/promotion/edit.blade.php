@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column justify-content-end w-75 mx-auto">
        <div class="h3 card-header font-weight-bold bg-dark text-white">
            Edit Promotion
        </div>
        <form action="/shops/{{$shop->id}}/promotion/{{$promotion->id}}"
              method="post">
            @method('PUT')
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="">
                <div class="m-2 card-header">
                    <label class="font-weight-bold">Reward</label>
                    <input class="w-100" type="text" name="reward_name" value="{{ old('reward_name') ?? $promotion->reward_name }}">
                </div>
                <div class="m-2 card-header">
                    <label class="font-weight-bold">Condition</label>
                    <br>
                    <textarea class="w-100" name="condition" rows="5" cols="20" >{{ old('condition') ?? $promotion->condition }}</textarea>
                </div>
                <div class="m-2 card-header">
                    <label class="font-weight-bold">Reward Image</label>
                    <input class="w-100" type="text" name="reward_img" value="{{ old('reward_img') ?? $promotion->reward_img }}">
                </div>
                <div class="d-flex align-items-baseline justify-content-around m-2 card-header">
                    <div>
                        <label class="font-weight-bold">Card</label>
                        <select name="template_id" class="h4">
                            @foreach($cards as $key => $card)
                                @if((old('template_id') ?? $promotion->template_id) == $key)
                                    <option value="{{ $key }}" selected>{{ $card }}</option>
                                @else
                                    <option value="{{ $key }}">{{ $card }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="font-weight-bold">Point </label>
                        <input class="text-center h4" type="text" name="point" value="{{ old('point') ?? $promotion->point }}">
                    </div>
                </div>
                <div class="m-2 card-header text-center">
                    <label class="font-weight-bold">Expiry Date:</label>
                    <input name="exp_date" type="date" class="" value="{{ old('exp_date') ?? explode(' ', $promotion->exp_date)[0] }}">
                    <input name="exp_time" type="time" class="" value="{{ old('exp_time') ?? explode(' ', $promotion->exp_date)[1] }}">
                </div>
                <div class="m-2 d-flex align-items-center card-header">
                    <button class="mx-auto btn btn-dark font-weight-bold" type="submit">submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection   