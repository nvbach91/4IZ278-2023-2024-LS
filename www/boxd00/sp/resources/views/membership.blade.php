@extends("base")

@section("content")
<div class="row">
    <div class="col">
        <div class="container mt-3">
            <h1>Členství</h1>
            <h2>Členství Plus</h2>
            <p>Toto členství vám poskytuje následující výhody:</p>
            <ul>
                <li>Sleva <b>10%</b> na všechny letenky</li>
                <li>Přístup do letištního salonku se slevou <b>50%</b></li>
            </ul>
            <p><b>Cena:</b> 9999,- Kč ročně</p>
            <form method="GET" action="/~boxd00/app/payment">
                @csrf
                <input type="number" class="d-none" name="membershipPrice" value="9999">
                @if (Auth::user()->membership < 1)
                <button type="submit" class="btn btn-primary">Zakoupit</button>
                @else
                <button type="submit" class="btn btn-primary" disabled>Zakoupit</button>
                @endif
            </form>
            <h2 class="mt-3">Členství Premium</h2>
            <p>Toto členství vám poskytuje následující výhody:</p>
            <ul>
                <li>Sleva <b>20%</b> na všechny letenky</li>
                <li>Přístup do letištního salonku <b>zdarma</b></li>
            </ul>
            <p><b>Cena:</b> 15999,- Kč ročně</p>
            <form method="GET" action="/~boxd00/app/payment">
                @csrf
                <input type="number" class="d-none" name="membershipPrice" value="15999">
                @if (Auth::user()->membership < 2)
                <button type="submit" class="btn btn-primary">Zakoupit</button>
                @else
                <button type="submit" class="btn btn-primary" disabled>Zakoupit</button>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection