@extends('layouts.app')

@section('content')
@auth
<div class="container py-2">
    <div class="card">
        <div class="card-header">
            <h3>
            {{ $id->name }}
            <span class="float-right"><form action="{{ url('/jobs/submit', auth()->user()->id) }}" method="post">
                        @csrf
                        @if (($id->demandPlaced - $id->demandFilled) == 0 && (($y == "[]")))
                        <div class="text-primary">Full</div>
                        @elseif (!($y == "[]"))
                        <button class="mx-1 btn btn-tiny btn-danger form-group" type="submit" name="ticket" value="{{ $id->id }}">&times;</button>
                        @else
                        <button class="mx-1 btn btn-tiny btn-success form-group" type="submit" name="ticket" value="{{ $id->id }}">&plus;</button>
                        @endif
                    </form></span>
            </h3>
        </div>
        <div class="card-body">
            <div class="container">
                <div class="row py-2">
                    <p class="col-sm-2 text-muted">Name:</p>
                    <p class="col-sm-10">{{ $id->name }}</p>
                </div>
                <div class="row py-2">
                    <p class="col-sm-2 text-muted">Description:</p>
                    <p class="col-sm-10">{{ $id->description }}</p>
                </div>
                <div class="row py-2">
                    <p class="col-sm-2 text-muted">Date:</p>
                    <p class="col-sm-10">{{ date('F d, Y', strtotime($id->startDate)) }} - {{ date('F d, Y',
                        strtotime($id->endDate)) }}</p>
                </div>
                <div class="row py-2">
                    <p class="col-sm-2 text-muted">Time:</p>
                    <p class="col-sm-10">{{ date('h:m A', strtotime($id->startTime)) }} - {{ date('h:m A',
                        strtotime($id->endTime)) }}</p>
                </div>
                <div class="row py-2">
                    <p class="col-sm-2 text-muted">Positions:</p>
                    <p class="col-sm-10">{{ $id->demandFilled }} / {{ $id->demandPlaced }}</p>
                </div>
                <div class="row py-2">
                    <p class="col-sm-2 text-muted">Salary:</p>
                    <p class="col-sm-10">${{ $id->payRate }}</p>
                </div>
                <div class="row py-2">
                    <p class="col-sm-2 text-muted">Status:</p>
                    @if ((($id->demandPlaced - $id->demandFilled) != 0) )
                    <p class="col-sm-10 text-success">Open</p>
                    @else
                    <p class="col-sm-10 text-danger">Closed</p>
                    @endif
                </div>
                <div class="row py-2">
                    <p class="col-sm-2 text-muted">Address:</p>
                    <p class="col-sm-10">{{ $x->address }}</p>
                </div>
            </div>
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
