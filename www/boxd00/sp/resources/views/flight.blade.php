@extends("base")

@php
    use Carbon\Carbon;

    $formatDate = Carbon::parse($flight->date)->format("d.m.Y");
    $formatTime = Carbon::parse($flight->connection->time)->format("H:i");
    $fromName = $flight->connection->from_destination->name;
    $toName = $flight->connection->to_destination->name;
@endphp

@section("content")
<div class="container mt-3">
    <h1>{{ $fromName }}-{{ $toName }}</h1>
    <h2>{{ $formatDate }} {{ $formatTime }}</h2>
    
    @if (count($tickets) != 0)
        @if (count($tickets) == 1)
        <p>Byla zakoupena <b>{{ count($tickets) }}</b> letenka.</p>
        @elseif (count($tickets) >= 2 and count($tickets) <= 4)
        <p>Byly zakoupeny <b>{{ count($tickets) }}</b> letenky.</p>
        @else
        <p>Bylo zakoupeno <b>{{ count($tickets) }}</b> letenek.</p>
        @endif

        @foreach ($tickets as $ticket)
            <li><b>Sedadlo {{ $ticket->seat }}</b>: {{ $ticket->passenger->first_name }} {{ $ticket->passenger->last_name }}</li>
        @endforeach
    @else
    <p>Zatím nebyly koupeny žádné letenky.</p>
    @endif
</div>
@endsection