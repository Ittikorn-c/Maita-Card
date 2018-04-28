@extends('layouts.app')

@section('content')
        <div class="page-header">
            <h1 style="text-align: center;">SCAN QR<br>
           
            </h1>
        </div>
        <div  class="container" style="width:100%">
        	<table>
        		<tr>
        			<td>
			            <div class="panel-body" align="center">
			                <video id="preview"></video>
			            </div>        				
        			</td>
        			<label id="role" hidden="true">{{ $role }}</label>
        			@if($role === 'employee')
        			<td>
			            <div class="panel-body" align="center">
			            	<h5>Result</h5>
							<form id="em" action="/escan" method="post">
								
								@csrf
								<!-- CSRF Cross-Site Request Forgery -->
								{{ csrf_field() }}

								<!-- role don't show but pass to store -->

								<label>Username: </label>
								<label id="result"></label>
								<input id="rid" hidden="true" type="number" name="uid" value="">
								<br>

								<label>Point: </label>
								<input type="number" name="point" value="{{ old('point') }}">
								<br>

								<button class="btn btn-primary" type="submit">Submit</button>
							</form>
	            
        				</div>   

        			</td>
        			@elseif ($role === 'customer')
	         			<td>
				            <div class="panel-body" align="center">
				            	<h5>Result</h5>
								<form id="cus" action="/cscan" method="post">
									@method('PUT')
									@csrf
									<!-- CSRF Cross-Site Request Forgery -->
									{{ csrf_field() }}

									<!-- role don't show but pass to store -->

									<label>Branch: </label>
									<label id="result"></label>
									<input id="rid" hidden="true" type="number" name="bid" value="">
									<br>

<!-- 									<label>Point: </label>
									<input type="number" name="checkinPoint" value="{{ old('checkinPoint') }}">
									<br> -->

									<button class="btn btn-primary" type="submit">Check In</button>
								</form>
		            
	        				</div>   

	        			</td>       			
        			@endif
        		</tr>
        	</table>

        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('/js/instascan.min.js') }}"></script>

    <script type="text/javascript">
      let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
      scanner.addListener('scan', function (content) {
        // console.log(content);
        if (content.startsWith("R")){
        	$('#em').attr('action', '#');
        }
        else {
        	if ($('#role').text() === 'employee'){
				$.ajax({
				    url: '/scanforuser/' + content,
				    type:"POST",
				    data: { _token: '{!! csrf_token() !!}', uid: content },
				    success:function(data){

		              $("#result").text(data);
		              $('#rid').val(content);
				    },
				    error:function(){
				        console.log("No data returned");
				    }
				});   

        	}
        	else {

				$.ajax({
				    url: '/scanforbranch/' + content,
				    type:"POST",
				    data: { _token: '{!! csrf_token() !!}', bid: content },
				    success:function(data){

		              $("#result").text(data);
		              $('#rid').val(content);
				    },
				    error:function(){
				        console.log("No data returned");
				    }
				});    		
        	}

        }
        
      });
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[0]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });
    </script>
@endsection

