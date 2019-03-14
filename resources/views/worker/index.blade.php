@extends('layouts.app')

@section('content')
    @auth
        <div class="container">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <h1>Welcome, {{ Auth::user()->email }}!<a href="{{ url('/worker/edit', auth()->user()->id) }}" class="btn btn-outline-success float-right">Edit</a></h1>
                    </div>
                @if (Auth::user()->personal_info == 0)
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
                                <input class="form-control shadow-sm" type="email" name="email" id="" placeholder="Email Address" value="{{ Auth::user()->email }}" required>
                            </div>

                            <button class="btn btn-outline-primary" type="submit">Submit</button>
                        </form>
                    </div>
                @else
                    <div class="card-body">
                        <h3 class="card-title">Personal Info:</h3>
                        @if ($pi->middleName != "")
                            <h4>Name: {{ $pi->firstName}} {{ $pi->middleName }} {{ $pi->lastName }}</h4>
                        @else
                            <h4>Name: {{ $pi->firstName}} {{ $pi->lastName }}</h4>
                        @endif
                        
                        @if ($pi->secondaryNumber != "")
                            <h4>Primary Number: {{ $pi->primaryNumber }}</h4>
                            <h4>Secondary Number: {{ $pi->secondaryNumber }}</h4>
                        @else
                            <h4>Primary Number: {{ $pi->primaryNumber }}</h4>
                        @endif
                    
                        <h4>Address: {{ $pi->address }}</h4>
                        <h4>Email Address: {{ $pi->email }}</h4>
                    </div>
                @endif
                </div>
            </div>
        </div>
    @endauth
    @guest
    <div class="container">
        <h5>Whoops! You haven't <a href="{{ ('register') }}">registered</a> for an acocunt yet!</h5>
    </div>
    @endguest
@endsection
