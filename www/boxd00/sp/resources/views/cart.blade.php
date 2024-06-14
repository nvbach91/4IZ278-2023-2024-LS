@extends("base")

@php
    use App\Models\Flight;
    use Carbon\Carbon;

    $tickets = session("bookedTickets", []);
    $now = Carbon::now();
    $validTickets = [];
    $totalPrice = 0;

    foreach ($tickets as $ticket) {
        if (Carbon::parse($ticket["reserved_until"])->isAfter($now)) {
            $validTickets[] = $ticket;
            $totalPrice += $ticket["price"];
        }
    }
@endphp

@section("content")
<div class="container mt-3">
    <h1>Košík</h1>
    @if (count($validTickets) == 0)
        <p>Váš košík je prázdný.</p>
    @else
    <p><b>Celková cena: </b>{{ $totalPrice }},- Kč</p>
    <form method="GET" action="/~boxd00/app/payment">
        @csrf
        <button type="submit" class="btn btn-primary">Zaplatit vše</button>
    </form>
    @endif
    @foreach ($validTickets as $ticket)
        @php
            $flight = Flight::findOrFail($ticket["flight_id"]);
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
                    <li><b>Sedadlo: </b>{{ $ticket["seat"] }}</li>
                    <li><b>Cena: </b>{{ $ticket["price"] }},- Kč</li>
                </ul>
                <form method="POST" action="/~boxd00/app/deleteticket">
                    @csrf
                    @method("DELETE")
                    <input type="number" class="d-none" name="tid" value="{{ $ticket['id'] }}">
                    <button type="submit" class="btn btn-primary">Smazat</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection