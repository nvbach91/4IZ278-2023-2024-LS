@extends("base")

@php
use Carbon\Carbon;

$formatDate = Carbon::parse($flight->date)->format("d.m.Y");
$formatTime = Carbon::parse($flight->connection->time)->format("H:i");
$class = str_starts_with($seat, "B") ? "business" : "economy";
@endphp
@section("content")
<div class="row justify-content-center mt-3">
    <div class="col-4">
        <h1>Vaše rezervace</h1>
        <ul>
            <li><b>Číslo letu: </b> {{ $flight->connection->flight_code }}</li>
            <li><b>Spojení: </b> {{ $flight->connection->from_destination->name }}-{{ $flight->connection->to_destination->name }}</li>
            <li><b>Datum: </b> {{ $formatDate }}</li>
            <li><b>Čas: </b> {{ $formatTime }}</li>
            <li><b>Třída: </b> {{ $class }}</li>
            <li><b>Sedadlo: </b> {{ $seat }}</li>
            <li><b>Cena: </b> {{ $price }}</li>
        </ul>
        <form method="POST" action="/~boxd00/app/addticket">
            @csrf
            <input type="text" class="d-none" name="seat" id="seat" value="{{ $seat }}">
            <input type="number" class="d-none" name="fid" id="fid" value="{{ $flight->id }}">
            <input type="text" class="d-none" name="ticketType" id="ticketType" value="{{ $ticketType }}">
            <input type="number" class="d-none" name="price" id="price" value="{{ $price }}">
            <input type="date" class="d-none" name="return" value="{{ $return }}">
            <button type="submit" class="btn btn-primary">Potvrdit</button>
        </form>
        <!-- <form method="GET" action="/backticket">
            <input type="text" class="d-none" name="seat" id="seat" value="{{ $seat }}">
            <input type="number" class="d-none" name="fid" id="fid" value="{{ $flight->id }}">
            <input type="text" class="d-none" name="ticketType" id="ticketType" value="{{ $ticketType }}">
            <input type="number" class="d-none" name="price" id="price" value="{{ $price }}">
            <input type="date" class="d-none" name="return" value="{{ $return }}">
            <button type="submit" class="btn btn-secondary mt-2">Zpět</button>
        </form> -->
    </div>
</div>
@endsection