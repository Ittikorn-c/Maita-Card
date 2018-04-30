@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column justify-content-end w-75 mx-auto">
        <div class="h3 card-header font-weight-bold bg-dark text-white">
            Edit Promotion
        </div>
        <form action="/shops/{{$shop->id}}/promotion/{{$promotion->id}}" enctype="multipart/form-data"
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
                    <i class="fa fa-gift" aria-hidden="true"></i>
                    <label class="font-weight-bold">Reward</label>
                    @if ($errors->first('reward_name'))
                        <input class="w-100 border border-danger" type="text" name="reward_name" value="{{ old('reward_name') ?? $promotion->reward_name }}">
                    @else
                        <input class="w-100" type="text" name="reward_name" value="{{ old('reward_name') ?? $promotion->reward_name }}">
                    @endif
                </div>
                <div class="m-2 card-header">
                    <i class="fa fa-th-list" aria-hidden="true"></i>
                    <label class="font-weight-bold">Condition</label>
                    <br>
                    @if ($errors->first('condition'))
                        <textarea class="w-100 border border-danger" name="condition" rows="5" cols="20" >{{ old('condition') ?? $promotion->condition }}</textarea>
                    @else
                        <textarea class="w-100" name="condition" rows="5" cols="20" >{{ old('condition') ?? $promotion->condition }}</textarea>
                    @endif
                </div>
                @if ($errors->first('reward_img'))
                    <div class="m-2 card-header border border-danger">
                        @else
                            <div class="m-2 card-header">
                                @endif
                    <div class="custom-file-container" data-upload-id="reward_img">
                        <i class="fa fa-picture-o" aria-hidden="true"></i>
                        <label class="font-weight-bold">Reward Image <a href="javascript:void(0)" class="text-danger custom-file-container__image-clear" title="Clear Image">x</a></label>
                        <label class="custom-file-container__custom-file" >
                            <input name="reward_img" type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*">
                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                            <span class="custom-file-container__custom-file__custom-file-control">{{ $promotion->reward_img }}</span>
                        </label>
                        <div class="custom-file-container__image-preview"></div>
                    </div>
                </div>
                <div class="d-flex align-items-baseline justify-content-around m-2 card-header">
                    <div>
                        <i class="fa fa-credit-card-alt" aria-hidden="true"></i>
                        <label class="font-weight-bold">Card</label>
                        @if ($errors->first('template_id'))
                            <select name="template_id" class="h4 border border-danger">
                                @foreach($cards as $key => $card)
                                    @if((old('template_id') ?? $promotion->template_id) == $key)
                                        <option value="{{ $key }}" selected>{{ $card }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $card }}</option>
                                    @endif
                                @endforeach
                            </select>
                        @else
                            <select name="template_id" class="h4">
                                @foreach($cards as $key => $card)
                                    @if((old('template_id') ?? $promotion->template_id) == $key)
                                        <option value="{{ $key }}" selected>{{ $card }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $card }}</option>
                                    @endif
                                @endforeach
                            </select>
                        @endif
                    </div>
                    <div>
                        <i class="fa fa-product-hunt" aria-hidden="true"></i>
                        <label class="font-weight-bold">Point </label>
                        @if ($errors->first('point'))
                            <input class="text-center h4 border border-danger" type="number" name="point" value="{{ old('point') ?? $promotion->point }}">
                        @else
                            <input class="text-center h4" type="number" name="point" value="{{ old('point') ?? $promotion->point }}">
                        @endif
                    </div>
                </div>
                @if ($errors->first('exp_date') or $errors->first('exp_time'))
                    <div class="m-2 card-header text-center border border-danger">
                        @else
                            <div class="m-2 card-header text-center">
                                @endif
                    <i class="fa fa-calendar-times-o" aria-hidden="true"></i>
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
    <script>
        var upload = new FileUploadWithPreview('reward_img')
    </script>
@endsection

@push("js")
    <script src="{{ asset('js/file-upload-with-preview.min.js') }}"></script>
@endpush
@push("css")
    <link rel="stylesheet" type="text/css" href="{{ asset('css/file-upload-with-preview.min.css') }}">
@endpush