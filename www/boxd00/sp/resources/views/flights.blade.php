@extends("base")

@php
use Carbon\Carbon;
@endphp

@section("content")
<div class="row">
    <div class="col">
        <div class="container mt-3">
            <h1>Správa letů</h1>
            <a href="{{ route('newdestination') }}"><button type="button" class="btn btn-primary mb-3">Vytvořit destinaci</button></a>
            <a href="{{ route('newconnection') }}"><button type="button" class="btn btn-primary mb-3">Vytvořit spojení</button></a>
            <a href="{{ route('newflight') }}"><button type="button" class="btn btn-primary mb-3">Vytvořit let</button></a>
            @foreach ($flights as $flight)
            @php
                $formatDate = Carbon::parse($flight->date)->format("d.m.Y");
                $formatTime = Carbon::parse($flight->connection->time)->format("H:i");
                $fromName = $flight->connection->from_destination->name;
                $toName = $flight->connection->to_destination->name;
            @endphp
            <a class="cardLink" href="{{ route('flight', ['fid' => $flight->id ]) }}"><div class="card mb-2 clickableCard">
                <div class="card-body">
                    <h5 class="card-title">{{ $fromName }} - {{ $toName }}</h5>
                    <h6 class="card-subtitle">{{ $flight->flight_code }}, {{ $formatDate }} {{ $formatTime }}</h6>
                </div>
            </div></a>
            @endforeach
        </div>
    </div>
</div>
@endsection