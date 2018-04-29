@extends("layouts.app")

@section("content")
    <div class="container" id="pointReceive-time">
        <div class="row">
            <div class="col-xs-12 col-md-8">
                <canvas style="padding:5px;" class="card-body" id="pointReceiveChart" width="400" max-height="100"></canvas>
            </div>
            <div class="col-xs-12 col-md-4 side-menu" style="height:300px">
                <h4>
                    Select Promotion
                </h4>
                <div class="side-scroll">
                    @foreach($datasets as $dataset)
                    <div class="form-check">
                        <input v-on:change="onCheckPromotion({{$dataset['template_id']}})" class="form-check-input promotion-checkbox" type="checkbox" value="" id="template-select-{{$dataset['template_id']}}" checked>
                        <label class='form-check-label'for="pointReceive-select-{{$dataset['template_id']}}">
                            {{ $dataset['template_name'] }}
                        </label>
                    </div>
                    @endforeach 
                </div>
                
            </div>
        </div>

        <div class="row">
            
            <div class="col-12">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="page1-tab" data-toggle="tab" href="#page1" role="tab" aria-controls="home" aria-selected="true">08:00 - 15:00</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="page2-tab" data-toggle="tab" href="#page2" role="tab" aria-controls="profile" aria-selected="false">16:00 - 23:00</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="page3-tab" data-toggle="tab" href="#page3" role="tab" aria-controls="contact" aria-selected="false">00:00 - 07:00</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="page1" role="tabpanel" aria-labelledby="home-tab">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Template Name</th>
                                    @for ($i = 8; $i < 16; $i++)
                                        <th scope="col">{{$i}}:00 - {{$i+1}}:00</th>
                                    @endfor
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($datasets as $dataset)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td><a href="">{{ $dataset['template_name'] }}</a></td>
                                    @for ($i = 8; $i < 16; $i++)
                                        <td>{{ $dataset['data'][$i] }}</td>
                                    @endfor
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="page2" role="tabpanel" aria-labelledby="profile-tab">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Template Name</th>
                                    @for ($i = 16; $i < 24; $i++)
                                        <th scope="col">{{$i}}:00 - {{$i+1}}:00</th>
                                    @endfor
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($datasets as $dataset)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $dataset['template_name'] }}</td>
                                    @for ($i = 16; $i < 24; $i++)
                                        <td>{{ $dataset['data'][$i] }}</td>
                                    @endfor
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="page3" role="tabpanel" aria-labelledby="contact-tab">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Template Name</th>
                                    @for ($i = 0; $i < 8; $i++)
                                        <th>{{$i}}:00 - {{$i+1}}:00</th>
                                    @endfor
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($datasets as $dataset)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $dataset['template_name'] }}</td>
                                    @for ($i = 0; $i < 8; $i++)
                                        <td>{{ $dataset['data'][$i] }}</td>
                                    @endfor
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
@endsection

@push("js")
    <script>
        var label = JSON.parse('{!! json_encode($label) !!}');
        var datasets = JSON.parse('{!! json_encode($datasets) !!}');

    </script>
    <script src="{{ asset('js/owner/reports/pointReceive/time.js') }}"></script>
@endpush
@push("css")
    <link href="{{ asset('css/report.css') }}" rel="stylesheet">
@endpush 