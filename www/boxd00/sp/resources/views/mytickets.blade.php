@extends("base")

@php
use App\Models\Flight;
use Carbon\Carbon;
@endphp

@section("content")
<div class="container mt-3">
    <h1>Moje letenky</h1>
    @foreach ($tickets as $ticket)
        @php
            $flight = Flight::findOrFail($ticket->flight_id);
            $connection = $flight->connection;

            $formatDate = Carbon::parse($flight->date)->format("d.m.Y");
            $formatTime = Carbon::parse($connection->time)->format("H:i");
            $className = $ticket["seat"] == 1 ? "Business" : "Economy";
        @endphp
        <div class="card mt-2">
            <div class="card-body">
                <h5 class="card-title">{{ $connection->from_destination->name }}-{{ $connection->to_destination->name }} ({{ $connection->flight_code }})</h5>
                <h6 class="card-subtitle">{{ $formatDate }} {{ $formatTime }}</h6>
                <ul>
                    <li><b>Třída: </b>{{ $className }}</li>
                    <li><b>Sedadlo: </b>{{ $ticket->seat }}</li>
                </ul>
            </div>
        </div>
    @endforeach
</div>
@endsection