@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column justify-content-end w-75 mx-auto">
        <div class="h3 card-header font-weight-bold bg-dark text-white">
            New Promotion
        </div>
        <form action="/shops/{{$shop->id}}/promotion"  enctype="multipart/form-data"
              method="post">
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
                    <input class="w-100" type="text" name="reward_name" value="{{ old('reward_name') }}">
                </div>
                <div class="m-2 card-header">
                    <label class="font-weight-bold">Condition</label>
                    <br>
                    <textarea class="w-100" name="condition" rows="5" cols="20" >{{ old('condition')}}</textarea>
                </div>
                <div class="m-2 card-header">
                    <div class="custom-file-container" data-upload-id="reward_img">
                        <label class="font-weight-bold">Reward Image <a href="javascript:void(0)" class="text-danger custom-file-container__image-clear" title="Clear Image">x</a></label>
                        <label class="custom-file-container__custom-file" >
                            <input name="reward_img" type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*">
                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                        </label>
                        <div class="custom-file-container__image-preview"></div>
                    </div>
                </div>
                <div class="d-flex align-items-baseline justify-content-around m-2 card-header">
                    <div>
                        <label class="font-weight-bold">Card</label>
                        <select name="template_id" class="h4">
                            @foreach($cards as $key => $card)
                                @if(old('template_id') == $key)
                                    <option value="{{ $key }}" selected>{{ $card }}</option>
                                @else
                                    <option value="{{ $key }}">{{ $card }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="font-weight-bold">Point </label>
                        <input class="text-center h4" type="text" name="point" value="{{ old('point') }}">
                    </div>
                </div>
                <div class="m-2 card-header text-center">
                    <label class="font-weight-bold">Expiry Date:</label>
                    <input name="exp_date" type="date" class="" value="{{ old('exp_date') }}">
                    <input name="exp_time" type="time" class="" value="{{ old('exp_time') }}">
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
