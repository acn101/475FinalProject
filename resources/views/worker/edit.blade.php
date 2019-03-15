@extends('layouts.app')

@section('content')
    @auth
        <div class="container py-2">

            <a class="my-2 btn btn-warning" href="{{ url('worker') }}">Go Back</a>

            <div class="card">
                <div class="card-header">
                    <h1>Editing, {{ Auth::user()->email }}'s personal information.</h1>
                </div>
                <div class="card-body">
                    <form action="{{ url('/worker/update', auth()->user()->id) }}" method="post">
                        @csrf

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="card-text" for="firstName">First Name</label>
                                    <input class="form-control shadow-sm" type="text" name="firstName" id="" value="{{ $pi->firstName }}"
                                        required>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label class="card-text" for="middleName">Middle Name (optional)</label>
                                    <input class="form-control shadow-sm" type="text" name="middleName" id="" value="{{ $pi->middleName }}">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label class="card-text" for="lastName">Last Name</label>
                                    <input class="form-control shadow-sm" type="text" name="lastName" id="" value="{{ $pi->lastName }}"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="card-text" for="primaryNumber">Phone Number</label>
                                    <input class="form-control shadow-sm" type="text" name="primaryNumber" id="" value="{{ $pi->primaryNumber }}"
                                        required>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label class="card-text" for="secondaryNumber">Secondary Number (optional)</label>
                                    <input class="form-control shadow-sm" type="text" name="secondaryNumber" id="" value="{{ $pi->secondaryNumber }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="card-text" for="address">Address</label>
                            <input class="form-control shadow-sm" type="text" name="address" id="" value="{{ $pi->address }}" required>
                        </div>

                        <div class="form-group">
                            <label class="card-text" for="email">Email Address</label>
                            <input class="text-white form-control bg-light" type="email" name="email" id="" value="{{ Auth::user()->email }}"
                                required disabled>
                        </div>

                        <button class="btn btn-success" type="submit">Save</button>
                    </form>
                </div>
            </div>
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
