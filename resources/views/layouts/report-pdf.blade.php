<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>
        @yield("title")
    </title>
    <base href="{{ url('/') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  </head>
  <body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12" >
                <h4 style="text-align:center">
                    @yield("header")
                </h4>
                <p>
                    for @yield("for") <br>
                    export at {{ \Carbon\Carbon::now()->format("j F Y H:i:s") }}
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
            <table class="table">
                <thead>
                    @yield("head")
                </thead>
                <tbody>
                    @yield("body")
                </tbody>
            </table>
            </div>
        </div>
    </div>
    
  </body>
</html>