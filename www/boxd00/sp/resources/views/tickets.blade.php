@extends("base")

@php
use Carbon\Carbon;
@endphp

@section("content")
<div class="row">
    <div class="col">
        <div class="container mt-3">
            <h1>Správa letenek</h1>
            <div class="accordion" id="ticketAccordion">
            @foreach ($flights as $flight)
                @php
                    $formatDate = Carbon::parse($flight->date)->format("d.m.Y");
                    $formatTime = Carbon::parse($flight->connection->time)->format("H:i");
                    $tickets = $flight->tickets->sortBy("seat");
                @endphp
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-{{ $flight->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $flight->id }}" aria-expanded="true" aria-controls="collapse-{{ $flight->id }}">
                            {{ $flight->connection->from_destination->name }}-{{ $flight->connection->to_destination->name }} ({{ $flight->flight_code }}, {{ $formatDate }} {{ $formatTime }})
                        </button>
                    </h2>
                    <div id="collapse-{{ $flight->id }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $flight->id }}" data-bs-parent="#ticketAccordion">
                        <div class="accordion-body">
                            @if (count($tickets) != 0)
                            <ul>
                                @foreach ($tickets as $ticket)
                                <li><b>Sedadlo {{ $ticket->seat }}:</b> {{ $ticket->passenger->first_name }} {{ $ticket->passenger->last_name }} </li>
                                @endforeach
                            </ul>
                            @else
                            <p>Tento let nemá žádné rezervované letenky.</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
</div>
@endsection