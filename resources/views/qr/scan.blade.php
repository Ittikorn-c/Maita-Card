@extends('layouts.app')

@section('content')
        <div class="page-header">
            <h1 style="text-align: center;">SCAN QR<br>
           
            </h1>
            <br>
            @if ($role === 'employee')
            <center><a href="/{{ $id }}/qr-code/Branch"><button class="btn btn-primary" >Branch's QR</button></a></center>
            @endif
            <br><br>
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
								<input hidden="true" type="number" name="bid" value="{{ $id }}">

								<label>Username: </label>
								<label id="result"></label>
								<input id="rid" hidden="true" type="number" name="uid" value="">
								<br>

								<label id="adcol">Point: </label>
								<input id="point" type="number" name="point" value="{{ old('point') }}">
								<br>

								<button class="btn btn-primary" type="submit">Confirm</button>
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
									<input id="rid" hidden="true" type="text" name="code" value="">
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
			$.ajax({
				url: '/scanforreward/' + content,
				type:"POST",
				data: { _token: '{!! csrf_token() !!}', code: content },
				success:function(data){

			        $("#result").text(data['username']);
			        $('#rid').val(data['reward_id']);
			        $('#adcol').text('Reward Name: ' + data['reward_name']);
			        $('#point').hide();
			        $('#point').val(data['point']);
			        $('#em').attr('action', '/rscan');
				},
				error:function(){
					console.log("No data returned");
				}
			});   

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
				    data: { _token: '{!! csrf_token() !!}', code: content },
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

