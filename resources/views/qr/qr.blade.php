@extends('layouts.app')

@section('content')
        <div class="page-header">
            <h1 style="text-align: center;">{{ $title }} QR<br>
           
            </h1>
        </div>
        <div id="QR-Code" class="container" style="width:100%">
            <div class="panel-body" align="center">
                {!! $qr !!}
            </div>
        </div>
    </div>
@endsection
<!-- <script>
    import Vue from 'vue';
    import VueQrcodeReader from 'vue-qrcode-reader';

    Vue.use(VueQrcodeReader);    
</script> -->
