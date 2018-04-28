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
        			@if($role === 'employee')
        			<td>
			            <div class="panel-body" align="center">
			            	<h5>Result</h5>
							<form action="/escan" method="post">
								
								@csrf
								<!-- CSRF Cross-Site Request Forgery -->
								{{ csrf_field() }}

								<!-- role don't show but pass to store -->
								<input hidden="true" type="text" name="role" value="{{ $role }}">

								<label>Username: </label>
								<input id="result" type="number" name="uid" value="">
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
								<form action="/cscan" method="post">
									@method('PUT')
									@csrf
									<!-- CSRF Cross-Site Request Forgery -->
									{{ csrf_field() }}

									<!-- role don't show but pass to store -->
									<input hidden="true" type="text" name="role" value="{{ $role }}">

									<label>Branch: </label>
									<input id="result" type="number" name="bid" value="">
									<br>

									<label>Point: </label>
									<input type="number" name="checkinPoint" value="{{ old('checkinPoint') }}">
									<br>

									<button class="btn btn-primary" type="submit">Submit</button>
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
        console.log(content);
        $('#result').val(content);
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

