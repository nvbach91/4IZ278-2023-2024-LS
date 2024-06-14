@php
use Carbon\Carbon;

if (!Auth::check()) {
    $multiple = 1;
} else {
    $multiple = 1 - (Auth::user()->membership * 0.1);
}
@endphp

@extends("base")

@section("content")
<div class="container mt-3">
    @if (isset($status) and $status == "return")
    <h1>Vyberte si zpáteční let ({{ request("from") }}-{{ request("to") }})</h1>
    @else
    <h1>Nalezené lety ({{ request("from") }}-{{ request("to") }})</h1>
    @endif
    @if (!isset($flights) || count($flights) == 0)
        <p>Bohužel nebyly nalezeny žádné lety.</p>
    @endif

    @foreach ($flights as $flightCode => $flightGroup)
    <h3>{{ $flightCode }}</h3>
    <div class="accordion" id="accordion-{{ $flightCode }}">
    @foreach ($flightGroup as $flight)
        @php
            $formatDate = Carbon::parse($flight->date)->format("d.m.Y");
            $formatTime = Carbon::parse($flight->connection->time)->format("H:i");
            $durationHours = intdiv($flight->connection->duration, 60);
            $durationMinutes = $flight->connection->duration % 60;
            $price = $flight->connection->price * $multiple;
            $economyPrice = round($price);
            $businessPrice = ceil(($price * 2) / 1000) * 1000 - 1;

            $vacantEconomy = 180 - $flight->economy_tickets_count;
            $vacantBusiness = 24 - $flight->business_tickets_count;
        @endphp
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading-{{ $flight->id }}">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $flight->id }}" aria-expanded="false" aria-controls="collapse-{{ $flight->id }}">
                    <b>{{ $formatDate }} {{ $formatTime }}</b>
                </button>
            </h2>
            <div id="collapse-{{ $flight->id }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $flight->id }}" data-bs-parent="#accordion-{{ $flightCode }}">
                <div class="accordion-body">
                    <b>Délka letu:</b> {{ $durationHours }} hodin {{ $durationMinutes }} minut<br/>
                    <b>Volných míst: </b> {{ $vacantEconomy + $vacantBusiness }} ({{ $vacantEconomy }} economy, {{ $vacantBusiness }} business)<br/>
                    <b>Ceny:</b>
                    <ul>
                        @if ($vacantEconomy > 0)
                        <li><b>Ekonomická třída: </b> {{ $economyPrice }},- Kč</li>
                        @endif
                        @if ($vacantBusiness > 0)
                        <li><b>Business třída: </b> {{ $businessPrice }},- Kč</li>
                        @endif
                    </ul>
                    @if ($vacantEconomy + $vacantBusiness > 0)
                    <form method="GET" action="/~boxd00/app/chooseseat">
                        @csrf
                        <input type="number" class="d-none" name="fid" value="{{ $flight->id }}">
                        <input type="text" class="d-none" name="ticketType" value="{{ request('ticketType') }}">
                        <input type="date" class="d-none" name="return" value="{{ $return }}">
                        <button type="submit" class="btn btn-primary">Objednat</button>
                    </form>
                    @else
                    <p style="color: red">Tento let je plně obsazen.</p>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
    </div>
    @endforeach
</div>
@endsection