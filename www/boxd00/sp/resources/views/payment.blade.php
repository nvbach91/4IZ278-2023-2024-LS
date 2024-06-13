@extends("base")

@php
    use Carbon\Carbon;

    $tickets = session("bookedTickets", []);
    $now = Carbon::now();
    $validTickets = [];
    /* $totalPrice = 0;

    if ($type != "membership") {
        foreach ($tickets as $ticket) {
            if (Carbon::parse($ticket["reserved_until"])->isAfter($now)) {
                $validTickets[] = $ticket;
                $totalPrice += $ticket["price"];
            }
        }
    } else {
        
    } */
@endphp

@section("content")
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-4">
            <h1>Platba</h1>
            <p><b>Částka k uhrazení</b>: {{ $totalPrice }},- Kč</p>
            <form method="POST" action="/payment" id="paymentForm">
                @csrf
                <div class="form-group">
                    <label for="cardName">Celé jméno</label>
                    <input type="text" class="form-control" id="cardName" placeholder="Jméno a příjmení" required>
                </div>
                <p class="errorText" id="nameAlert">Zadané jméno je neplatné.</p>
                <div class="form-group mt-2">
                    <label for="cardNumber">Číslo karty</label>
                    <input type="text" class="form-control" id="cardNumber" placeholder="Zadejte číslo karty" required>
                </div>
                <p class="errorText" id="numberAlert">Zadané číslo karty je neplatné.</p>
                <div class="form-group mt-2">
                    <label for="expiryDate">Platnost karty</label>
                    <input type="text" class="form-control" id="expiryDate" placeholder="MM/RR" required>
                </div>
                <p class="errorText" id="badDateAlert">Zadaná hodnota je neplatná.</p>
                <p class="errorText" id="expiryAlert">Platnost karty již vypršela.</p>
                <div class="form-group mt-2">
                    <label for="cvv">CVV</label>
                    <input type="text" class="form-control" id="cvv" placeholder="CVV" required>
                </div>
                <p class="errorText" id="cvvAlert">Zadané CVV je neplatné.</p>
                <input type="text" class="d-none" name="type" value="{{ $type }}">
                <input type="number" class="d-none" name="price" value="{{ $totalPrice }}">
                <button type="submit" class="btn btn-primary mt-3" id="paymentButton" disabled>Uhradit</button>
            </form>
        </div>
    </div>
</div>
@endsection