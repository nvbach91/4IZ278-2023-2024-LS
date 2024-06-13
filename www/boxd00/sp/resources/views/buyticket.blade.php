@extends("base")

@php
use Carbon\Carbon;
$formatDate = Carbon::parse($flight->date)->format("d.m.Y");
$formatTime = Carbon::parse($flight->connection->time)->format("H:i");

$multiple = 1 - (Auth::user()->membership * 0.1);
$price = $flight->connection->price * $multiple;
$economyPrice = round($price);
$businessPrice = ceil(($price * 2) / 1000) * 1000 - 1;
@endphp

@section("misc_styles")
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/seat_table.css') }}">
@endsection

@section("content")
<div class="container mt-3">
    <div class="row">
        <h1>Koupit letenku</h1>
        <div class="col-6">
            <h2>Detaily</h2>
            <ul>
                <li><b>Číslo letu: </b>{{ $flight->connection->flight_code }}</li>
                <li><b>Z: </b>{{ $fromDestination->name }} ({{ $fromDestination->airport_code }})</li>
                <li><b>Do: </b>{{ $toDestination->name }} ({{ $toDestination->airport_code }})</li>
                <li><b>Datum: </b>{{ $formatDate }}</li>
                <li><b>Čas: </b>{{ $formatTime }}</li>
            </ul>
        </div>
        <div class="col-6">
            <h2>Výběr místa</h2>
            <ul>
                <li><b>Vybrané místo: </b> <em id="chosenSeat">žádné</em></li>
                <li><b>Třída: </b> <em id="chosenClass">žádná</em></li>
                <li><b>Cena: </b> <b id="chosenPrice">0</b>,- Kč</li>
            </ul>
            <div class="table-responsive" style="max-height: 25rem" id="tableDiv">
                <table id="seatTable" class="table table-bordered"></table>
            </div>
            <form method="POST" action="/addticket">
                @csrf
                <button type="submit" class="btn btn-primary float-end mt-3" id="buyButton" disabled>Koupit</button>
                <input type="text" class="d-none" name="seat" id="seat">
                <input type="number" class="d-none" name="fid" id="fid" value="{{ $flight->id }}">
                <input type="text" class="d-none" name="ticketType" id="ticketType" value="{{ $ticketType }}">
                <input type="number" class="d-none" name="price" id="price">
                <input type="date" class="d-none" name="return" value="{{ $return }}">
            </form>
        </div>
    </div>
</div>
@endsection

@section("misc_scripts")
<script type="text/javascript">
    const economyPrice = {{ $economyPrice }}; // no error here
    const businessPrice = {{ $businessPrice }};
    const occupiedSeats = @json($occupiedSeats);
</script>
<script type="text/javascript" src="{{ asset('js/seat_table.js') }}"></script>
@endsection