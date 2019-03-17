@extends('layouts.app')

@section('content')
<div style="height:100vh;" class="container-fluid overflow-hidden p-0 m-0 justify-content-md-center">
        <img style="filter: brightness(40%); z-index: -1; object-fit: cover;" src="{{ asset('/img/bp.jpg') }}" class="w-100 h-100 img-fluid position-absolute">
        <div class="container h-100 py-5 a-cb text-center">
            <h1>Welcome to <span class="text-warning">MALT Job Services!</span></h1>
            <br>
            <h4>Our system simplifies the process of applying for jobs with an easy to use interface</h4>
            <p style="margin-top: 40%;">Please <a href="{{ url('/register') }}">register</a> to use our services</p>
        </div>
    </div>
</div>
@endsection
