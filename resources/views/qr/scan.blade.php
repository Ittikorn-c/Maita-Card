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
        			<td>
        				<h5>Result: </h5>
        				<p id="result"></p>
        			</td>
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
        $('#result').text(content);
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

