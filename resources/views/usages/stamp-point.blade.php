
@section('content')

<form action="stamp-point" method="post">
								
	@csrf
	<!-- CSRF Cross-Site Request Forgery -->
	{{ csrf_field() }}

	<!-- role don't show but pass to store -->
	<input hidden="true" type="text" name="role" value="{{ $role }}">

	<label>Username: </label>
	<input id="result" type="text" name="uname" value="">
	<br>

	<label>Point: </label>
	<input type="text" name="pwd" value="{{ old('pwd') }}">
	<br>

	<button class="btn btn-primary" type="submit">Submit</button>
</form>

@endsection