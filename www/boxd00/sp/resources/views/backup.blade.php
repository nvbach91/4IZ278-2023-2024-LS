<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BlueJet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg" id="navbar" style="background-color: #154360">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <a class="navbar-brand" href="#">BlueJet</a>
                <li class="nav-item">
                    <a class="nav-link" href="#">O nás</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Destinace</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Členství</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Správa letenky</a>
                </li>
            </ul>
            <div class="ms-auto">
                <button type="button" class="btn btn-primary">Přihlásit se</button>
            </div>
        </div>
    </nav>

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
                            <form method="POST" action="/findtickets">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="ticketType" id="ticketTypeOneWay">
                                            <label class="form-check-label" for="ticketTypeOneWay">Jednosměrná</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="ticketType" id="ticketTypeTwoWay">
                                            <label class="form-check-label" for="ticketTypeTwoWay">Zpáteční</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label>Let z</label>
                                        <select class="form-select" aria-label="Select">
                                            <option selected>Praha</option>
                                            <optgroup label="Argentina">
                                                <option>Buenos Aires</option>
                                            </optgroup>
                                            <optgroup label="Brazílie">
                                                <option>Rio de Janeiro</option>
                                            </optgroup>
                                            <optgroup label="Spojené státy">
                                                <option>Chicago</option>
                                                <option>New York</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label>Let do</label>
                                        <select class="form-select" aria-label="Select">
                                            <option selected>Praha</option>
                                            <optgroup label="Argentina">
                                                <option>Buenos Aires</option>
                                            </optgroup>
                                            <optgroup label="Brazílie">
                                                <option>Rio de Janeiro</option>
                                            </optgroup>
                                            <optgroup label="Spojené státy">
                                                <option>Chicago</option>
                                                <option>New York</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Datum odletu</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Datum návratu</label>
                                            <input type="text" class="form-control">
                                        </div>
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
                <h1 class="mt-3">Placeholder</h1>
                <p>
                    Information and section placeholder
                </p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>