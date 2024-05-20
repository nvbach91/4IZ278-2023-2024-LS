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
                <a class="navbar-brand" href="{{ route('index') }}">BlueJet</a>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}">O nás</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('destinations') }}">Destinace</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('membership') }}">Členství</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tickets') }}">Správa letenky</a>
                </li>
            </ul>
            <div class="ms-auto">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#login-modal">Přihlásit se</button>
            </div>
        </div>
    </nav>

    @yield("content")

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>