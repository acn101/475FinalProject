@extends('layouts.app')

@section('content')
@auth
<div class="container py-4">
    <!-- pagination -->
    <div class="row justify-content-sm-center">
        <div class="col-sm-auto">{{ $wts->appends(['sort' => $sort, 'order' => $order])->links() }}</div>
    </div>

    <table class="table table-responsive table-striped bg-dark">
        <thead>
            <tr>
                <th scope="col"><a class="text-light" href="?order=name&sort={{ $sort }}&c=1">Name</a></th>
                <th scope="col"><a class="text-light" href="?order=description&sort={{ $sort }}&c=1">Description</a></th>
                <th scope="col"><a class="text-light" href="?order=startDate&sort={{ $sort }}&c=1">Date</a></th>
                <th scope="col"><a class="text-light" href="?order=startTime&sort={{ $sort }}&c=1">Time</a></th>
                <th scope="col"><a class="text-light" href="?order=demandFilled&sort={{ $sort }}&c=1">Positions</a></th>
                <th scope="col"><a class="text-light" href="?order=payRate&sort={{ $sort }}&c=1">Salary</a></th>
                <th scope="col">Status</th>
                <th scope="col">Apply</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($wts as $wt)
            <tr>
                <th scope="row"><a class="text-warning" href="{{ url('/jobs', $wt->id) }}">{{ $wt->name }}</a></th>
                <td>{{ $wt->description }}</td>
                <td>{{ date('F d, Y', strtotime($wt->startDate)) }} - {{ date('F d, Y', strtotime($wt->endDate)) }}</td>
                <td>{{ date('h:m A', strtotime($wt->startTime)) }} - {{ date('h:m A', strtotime($wt->endTime)) }}</td>
                <td>{{ $wt->demandFilled }} / {{ $wt->demandPlaced }}</td>
                <td>${{ $wt->payRate }}</td>
                <td>
                    @if ((($wt->demandPlaced - $wt->demandFilled) != 0) )
                    <p class="text-success">Open</p>
                    @else
                    <p class="text-danger">Closed</p>
                    @endif
                </td>

                <!-- form start -->
                <td>
                    <form action="{{ url('/jobs/submit', auth()->user()->id) }}" method="post">
                        @csrf
                        @if (($wt->demandPlaced - $wt->demandFilled) == 0 && (!isset($wt->workerID)) )
                        <div class="text-primary">Full</div>
                        @elseif (isset($wt->workerID))
                        <button class="mx-1 btn btn-tiny btn-danger form-group" type="submit" name="ticket" value="{{ $wt->id }}">&times;</button>
                        @else
                        <button class="mx-1 btn btn-tiny btn-success form-group" type="submit" name="ticket" value="{{ $wt->id }}">&plus;</button>
                        @endif
                    </form>
                </td>
                <!-- form end -->

            </tr>
            @endforeach
        </tbody>
    </table>
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
