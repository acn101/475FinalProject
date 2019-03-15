@extends('layouts.app')

@section('content')
@auth
<div class="container py-2">
    @if (Auth::user()->personal_info == 0)
    <div class="card">
        <div class="card-header">
            <h3>Welcome, <span class="text-primary">{{ Auth::user()->email }}</span>!</h3>
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
                            <input class="form-control shadow-sm" type="text" name="firstName" id="" placeholder="First Name"
                                required>
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
                            <input class="form-control shadow-sm" type="text" name="lastName" id="" placeholder="Last Name"
                                required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label class="card-text" for="primaryNumber">Phone Number</label>
                            <input class="form-control shadow-sm" type="text" name="primaryNumber" id="" placeholder="Phone Number"
                                required>
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
                    <input class="form-control shadow-sm" type="text" name="address" id="" placeholder="Address"
                        required>
                </div>

                <div class="form-group">
                    <label class="card-text" for="email">Email Address</label>
                    <input class="form-control shadow-sm" type="email" name="email" id="" placeholder="Email Address"
                        value="{{ Auth::user()->email }}" required disabled>
                </div>

                <button class="btn btn-outline-primary" type="submit">Submit</button>
            </form>
        </div>
    </div>
    @else

    <h2>Welcome, <span class="text-primary">{{ Auth::user()->email }}</span>!</h2>

    <!-- <div class="row"> -->
    <!-- <div class="col-sm-6"> -->
    <div class="card">
        <div class="card-header">
            <h3>Personal Information
                @if ($s->id == 1)
                <span class="badge badge-success">{{ $s->description }}</span>
                @else
                <span class="badge badge-danger">{{ $s->description }}</span>
                @endif
                <a href="{{ url('/worker/edit', auth()->user()->id) }}" class="btn btn-info float-right">Edit Profile</a></h3>
        </div>
        <div class="card-body row">
            @if ($pi->middleName != "")
            <h5 class="col-sm-4 py-2"><span class="text-muted">Name:</span> {{ $pi->firstName}} {{
                $pi->middleName }} {{ $pi->lastName }}</h5>
            @else
            <h5 class="col-sm-4 py-2"><span class="text-muted">Name:</span> {{ $pi->firstName}} {{
                $pi->lastName }}</h5>
            @endif

            @if ($pi->secondaryNumber != "")
            <h5 class="col-sm-4 py-2"><span class="text-muted">Primary Number:</span> {{
                $pi->primaryNumber }}</h5>
            <h5 class="col-sm-4 py-2"><span class="text-muted">Secondary Number:</span> {{
                $pi->secondaryNumber }}</h5>
            @else
            <h5 class="col-sm-4 py-2"><span class="text-muted">Primary Number:</span> {{
                $pi->primaryNumber }}</h5>
            @endif

            <h5 class="col-sm-4 py-2"><span class="text-muted">Address:</span> {{ $pi->address }}</h5>
            <h5 class="col-sm-4 py-2"><span class="text-muted">Email Address:</span> {{ $pi->email }}</h5>
        </div>
    </div>
    <!-- </div> -->

    <br>

    <!-- <div class="col-sm-6"> -->
    <div class="card">
        <div class="card-header">
            <h3>Certifications<a href="{{ url('/workercerts/edit', auth()->user()->id) }}" class="btn btn-info float-right">Edit
                    Certifications</a></h3>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($wcs as $wc)
                <div class="col-sm-6">
                    <ul class="list-group">
                        <li class="list-group-item">•&nbsp;&nbsp;{{ $wc->description }}</li>
                    </ul>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- </div> -->
    <!-- </div> -->

    <br>

    <!-- job start -->
    <div class="card">
        <div class="card-header">
            <h3>Your Jobs<a href="{{ url('/jobs') }}" class="btn btn-info float-right">Edit
                    Jobs</a></h3>
        </div>
        <div class="card-body">
            @foreach ($wts as $wt)
            <div class="container py-2">
                <div class="row">
                    <div class="col-sm-2">
                        <span class="text-muted">Job: </span> <a href="{{ url('/jobs', $wt->id) }}">{{ $wt->name }}</a>
                    </div>
                    <div class="col-sm-10">
                        <span class="text-muted">Description: </span> {{ $wt->description }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- end jobs -->
    @endif
</div>
@endauth
@guest
<div class="container py-2">
    <div class="alert alert-dismissible alert-danger">
        <strong>Oh snap!</strong> You must <a href="{{ url('/register') }}" class="alert-link">register</a> to access
        our service.
    </div>
</div>
@endguest
@endsection
