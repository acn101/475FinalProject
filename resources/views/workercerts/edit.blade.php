@extends('layouts.app')

@section('content')
    @auth
    <div class="container py-2">

        <a class="my-2 btn btn-warning" href="{{ url('worker') }}">Go Back</a>

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
                                    <button class="mx-1 btn btn-small btn-danger" type="submit" name="cert" value="{{ $wc->id }}">&times;</button>
                                @else
                                    <button class="mx-1 btn btn-small btn-success" type="submit" name="cert" value="{{ $wc->id }}">&plus;</button>
                                @endif
                                <label for=""><h5>{{ $wc->description }}</h5></label>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endauth
    @guest
    <div class="container py-2">
        <h5>Whoops! You haven't <a href="{{ url('register') }}">registered</a> for an account yet!</h5>
    </div>
    @endguest
@endsection
