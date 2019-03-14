@extends('layouts.app')

@section('content')
    @auth
    <div class="container">

        <div class="card">
            <div class="card-header">
                <h3>Edit Certifications</h3>
            </div>
            <div class="card-body">
                <!-- do this stuff -->
            </div>
        </div>

        <br>

        <a class="btn btn-secondary" href="{{ url('worker') }}">Go Back</a>
    </div>
    @endauth
    @guest
    <div class="container">
        <h5>Whoops! You haven't <a href="{{ ('register') }}">registered</a> for an account yet!</h5>
    </div>
    @endguest
@endsection
