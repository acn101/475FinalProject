@extends('layouts.app')

@section('content')
    @auth
        <div class="container">
        @if (Auth::user()->personal_info == 0)
            <div class="card">
                <div class="card-header">
                    <h3>Welcome, {{ Auth::user()->email }}!
                    @if ($s->id == 1)
                        <span class="badge badge-success">{{ $s->description }}</span>
                    @else
                        <span class="badge badge-danger">{{ $s->description }}</span>
                    @endif
                    <a href="{{ url('/worker/edit', auth()->user()->id) }}" class="btn btn-outline-success float-right">Edit</a></h3>
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
                    <a href="{{ url('/worker/edit', auth()->user()->id) }}" class="btn btn-outline-success float-right">Edit Profile</a></h3>
                </div>
                <div class="card-body">
                    <h4 class="card-title">Personal Info:</h4>
                    @if ($pi->middleName != "")
                        <h5>Name: {{ $pi->firstName}} {{ $pi->middleName }} {{ $pi->lastName }}</h5>
                    @else
                        <h5>Name: {{ $pi->firstName}} {{ $pi->lastName }}</h5>
                    @endif
                    
                    @if ($pi->secondaryNumber != "")
                        <h5>Primary Number: {{ $pi->primaryNumber }}</h5>
                        <h5>Secondary Number: {{ $pi->secondaryNumber }}</h5>
                    @else
                        <h5>Primary Number: {{ $pi->primaryNumber }}</h5>
                    @endif
                
                    <h5>Address: {{ $pi->address }}</h5>
                    <h5>Email Address: {{ $pi->email }}</h5>
                </div>
            </div>

            <br>

            <div class="card">
                <div class="card-header">
                    <h3>Certifications<a href="{{ url('/workercerts/edit', auth()->user()->id) }}" class="btn btn-outline-success float-right">Edit Certifications</a></h3>
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
        <h5>Whoops! You haven't <a href="{{ ('register') }}">registered</a> for an account yet!</h5>
    </div>
    @endguest
@endsection
