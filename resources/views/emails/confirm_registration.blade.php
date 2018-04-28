<!-- Fonts -->
<link rel="dns-prefetch" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<div class="container-fluid">
    <div class="row">
        <div class="col-6" style="margin:0 auto">
            <div class="card-header">
                <h3><b>Confirm your registration</b></h3>
            </div>
            <div class="card-body">
                Hi {{ $user->fname . " " . $user->lname}}
            </div>
        </div>
    </div>
</div>