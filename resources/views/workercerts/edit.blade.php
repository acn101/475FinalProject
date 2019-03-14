@extends('layouts.app')

@section('content')
    @auth
    <div class="container">

        <div class="card">
            <div class="card-header">
                <h3>Edit Certifications</h3>
            </div>
            <div class="card-body">
                <div class="row">

                    @foreach ($wcs as $wc)
                        <div class="col-sm-4 py-1">
                            <form action="/workercerts/update/{{ auth()->user()->id }}" method="post">
                                @csrf
                                @if (isset($wc->certificationID))
                                    <button class="btn btn-danger" type="submit" name="cert" value="{{ $wc->id }}">&nbsp-</button>
                                @else
                                    <button class="btn btn-success" type="submit" name="cert" value="{{ $wc->id }}">+</button>
                                @endif
                                <label for=""><h5>{{ $wc->description }}</h5></label>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <br>
        <div class="container">
            <a class="btn btn-secondary" href="{{ url('worker') }}">Go Back</a>
        </div>
    </div>
    @endauth
    @guest
    <div class="container">
        <h5>Whoops! You haven't <a href="{{ url('register') }}">registered</a> for an account yet!</h5>
    </div>
    @endguest
@endsection
