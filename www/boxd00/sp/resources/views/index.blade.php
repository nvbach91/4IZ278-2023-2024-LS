@extends("base")

@section("content")
<div class="row" id="ticketbox-bg-row">
    <div class="col">
        <div class="container-fluid" id="ticketbox-bg">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-4" id="mottobox">
                    <h1>Leťte s BlueJet</h1>
                    <p>Vzletíme s vámi vždy vysoko a daleko.</p>
                </div>
                <div class="col-4">
                    <div class="container-fluid" id="ticketbox">
                        <form method="GET" action="/~boxd00/app/connections">
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="ticketType" value="oneway" id="ticketTypeOneWay">
                                        <label class="form-check-label" for="ticketTypeOneWay">Jednosměrná</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="ticketType" value="twoway" id="ticketTypeTwoWay">
                                        <label class="form-check-label" for="ticketTypeTwoWay">Zpáteční</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label>Let z</label>
                                    <select class="form-select" aria-label="Select" name="from" id="fromDestination" disabled>
                                        <option value="PRG" selected>Praha</option>
                                        @foreach ($groupedDestinations as $country => $destinations)
                                            @if ($country != "Česká republika")
                                            <optgroup label="{{ $country }}">
                                                @foreach ($destinations as $destination)
                                                    <option value="{{ $destination->airport_code }}">{{ $destination->name }}</option>
                                                @endforeach
                                            </optgroup>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label>Let do</label>
                                    <select class="form-select" aria-label="Select" name="to" id="toDestination" disabled>
                                        <!-- <option value="PRG" selected>Praha</option> -->
                                        <option selected disabled></option>
                                        @foreach ($groupedDestinations as $country => $destinations)
                                            @if ($country != "Česká republika")
                                            <optgroup label="{{ $country }}">
                                                @foreach ($destinations as $destination)
                                                    <option value="{{ $destination->airport_code }}">{{ $destination->name }}</option>
                                                @endforeach
                                            </optgroup>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Datum odletu</label>
                                        <input type="date" class="form-control" id="departureDate" name="departure" disabled>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Datum návratu</label>
                                        <input type="date" class="form-control" id="returnDate" name="return" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <p class="errorText" id="todayAlert">Lety lze objednávat pouze od následujícího dne.</p>
                                <p class="errorText" id="dateAlert">Datum návratu musí být později než datum odletu.</p>
                            </div>
                            <div class="row mt-2">
                                <div class="col d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary" id="searchFlightsButton" disabled>Vyhledat</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-2"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="container">
            <h1 class="mt-3">Vítejte</h1>
            <p>Vítejte u BlueJet Airlines, vašeho průvodce k dobrodružství na vzdálených destinacích po celém světě. S pýchou sídlíme v srdci Prahy, odkud vzlétají naše moderní letadla, připravená splnit vaše největší cestovatelské sny.</p>
            <p>Od Ameriky přes Afriku až po Asii, naše síť tras zahrnuje širokou škálu destinací, které vám umožní prozkoumat krásy světa a objevit nové kultury a zážitky. Bezpečnost a komfort našich cestujících je naší nejvyšší prioritou, a proto se naše posádky starají o vaše pohodlí a bezpečí od odletu až do příletu.</p>
            <p>Připojte se k nám na palubě BlueJet Airlines a nechte se unášet na nezapomenutelné cestě, která překročí hranice a přivede vás do nových světů.</p>
        </div>
    </div>
</div>
@endsection

@section("modals")
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section("misc_scripts")
@if (session("success"))
<script type="text/javascript">
    alert("{{ session('success') }}");
</script>
@endif
@endsection