@extends('layouts.app')

@section('content')
    @auth
        <div class="container">
        @if (Auth::user()->personal_info == 0)
            <div class="card">
                <div class="card-header">
                    <h3>Welcome, {{ Auth::user()->email }}!</h3>
                </div>
                <div class="card-body">
                    <h5 class="card-title">
                        Please fill out the form below to continue.
                    </h5>
                    <form action="{{ url('/worker/store') }}" method="post">
                        @csrf

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="card-text" for="firstName">First Name</label>
                                    <input class="form-control shadow-sm" type="text" name="firstName" id="" placeholder="First Name" required>
                                </div>
                            </div>
                            
                            <div class="col">
                                <div class="form-group">
                                    <label class="card-text" for="middleName">Middle Name (optional)</label>
                                    <input class="form-control shadow-sm" type="text" name="middleName" id="" placeholder="Middle Name">
                                </div>
                            </div>
                            
                            <div class="col">
                                <div class="form-group">
                                    <label class="card-text" for="lastName">Last Name</label>
                                    <input class="form-control shadow-sm" type="text" name="lastName" id="" placeholder="Last Name" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="card-text" for="primaryNumber">Phone Number</label>
                                    <input class="form-control shadow-sm" type="text" name="primaryNumber" id="" placeholder="Phone Number" required>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label class="card-text" for="secondaryNumber">Secondary Number (optional)</label>
                                    <input class="form-control shadow-sm" type="text" name="secondaryNumber" id="" placeholder="Secondary Number">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="card-text" for="address">Address</label>
                            <input class="form-control shadow-sm" type="text" name="address" id="" placeholder="Address" required>
                        </div>

                        <div class="form-group">
                            <label class="card-text" for="email">Email Address</label>
                            <input class="form-control shadow-sm" type="email" name="email" id="" placeholder="Email Address" value="{{ Auth::user()->email }}" required disabled>
                        </div>

                        <button class="btn btn-outline-primary" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        @else
            <div class="card">
                <div class="card-header">
                    <h3>Welcome, {{ Auth::user()->email }}!
                    @if ($s->id == 1)
                        <span class="badge badge-success">{{ $s->description }}</span>
                    @else
                        <span class="badge badge-danger">{{ $s->description }}</span>
                    @endif
                    <a href="{{ url('/worker/edit', auth()->user()->id) }}" class="btn btn-info float-right">Edit Profile</a></h3>
                </div>
                <div class="card-body">
                    <h4 class="card-title">Personal Info:</h4>
                    @if ($pi->middleName != "")
                        <p id="a-pfont">Name: {{ $pi->firstName}} {{ $pi->middleName }} {{ $pi->lastName }}</p id="a-pfont">
                    @else
                        <p id="a-pfont">Name: {{ $pi->firstName}} {{ $pi->lastName }}</p id="a-pfont">
                    @endif
                    
                    @if ($pi->secondaryNumber != "")
                        <p id="a-pfont">Primary Number: {{ $pi->primaryNumber }}</p id="a-pfont">
                        <p id="a-pfont">Secondary Number: {{ $pi->secondaryNumber }}</p id="a-pfont">
                    @else
                        <p id="a-pfont">Primary Number: {{ $pi->primaryNumber }}</p id="a-pfont">
                    @endif
                
                    <p id="a-pfont">Address: {{ $pi->address }}</p id="a-pfont">
                    <p id="a-pfont">Email Address: {{ $pi->email }}</p id="a-pfont">
                </div>
            </div>

            <br>

            <div class="card">
                <div class="card-header">
                    <h4>Certifications<a href="{{ url('/workercerts/edit', auth()->user()->id) }}" class="btn btn-info float-right">Edit Certifications</a></h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($wcs as $wc)
                            <div class="col-sm-4 py-1">
                                <h5>{{ $wc->description }}</h5>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        </div>
    @endauth
    @guest
    <div class="container">
        <div class="alert alert-dismissible alert-danger">
            <strong>Oh snap!</strong> You must <a href="{{ url('/register') }}" class="alert-link">register</a> to access our service.
        </div>
    </div>
    @endguest
@endsection
