@extends('layouts.app')

@section('content')
<header>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <!-- Slide One - Set the background image for this slide in the line below -->

          
          @foreach($promotionHighlight as $promotionH)

          <div 
          @if($loop->first)
          class="carousel-item active" 
          @else
          class="carousel-item" 
          @endif
          style='background-image: url({{ url("storage/promotions/".$promotionH["reward_img"]) }})'>
            <div class="carousel-caption d-none d-md-block">
              <h3 ><span style="background:rgba(0, 0, 0, 0.4)">{{ $promotionH["reward_name"]}}</span></h3>
            </div>
          </div>
          @endforeach

      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </header>

  <!-- Page Content -->
  <div class="container">
    <!-- Portfolio Section -->
    <h2>Promotions</h2>

    <div class="row">
      @foreach($promotions as $promotion)
      <div class="col-lg-4 col-sm-6 portfolio-item">
        <div class="card h-100">
          <a href="{{url('/maitahome/' . $promotion->id)}}"><img class="card-img-top" src='{{ url("storage/promotions/$promotion->reward_img") }}' alt="{{$promotion->logo_img}}" style="width:100%;max-width:400px;height:300px"></a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="{{url('/maitahome/' . $promotion->id)}}">{{$promotion->reward_name}}</a>
            </h4>

            <strong><p class="card-text">Point: {{$promotion->point}}</p></strong>
            <p class="card-text">expired date: {{ \Carbon\Carbon::parse($promotion->exp_date)->diffForHumans() }}</p>
          </div>
        </div>
      </div>
      @endforeach
    </div>

    <!-- /.row -->

    <!-- /.row -->

    <hr>



  </div>
  <!-- /.container -->

  <!-- Footer -->


@endsection

@push('css')
<link href="{{ asset('css/maitahome.css') }}" rel="stylesheet">
@endpush
