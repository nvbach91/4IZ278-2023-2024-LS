<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BlueJet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    @yield("misc_styles")
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
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('membership') }}">Členství</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('mytickets') }}">Moje letenky</a>
                </li>
                @if (Auth::user()->is_admin)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tickets') }}">Správa letenek</a>
                </li>
                @endif
                @endauth
            </ul>
            <div class="ms-auto">
                @guest
                    <a href="/login"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#login-modal">Přihlásit se</button></a>
                @endguest
                @auth
                <div class="d-flex align-items-center">
                    <a href="{{ route('cart') }}"><i class="bi bi-cart-fill me-2" style="color: white; font-size: 1.5rem"></i></a>
                    <a href="{{ route('profile') }}" id="profileLink"><span class="text-light mb-0"><b>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</b></span></a>
                    <form method="POST" action="{{ route('logout') }}" class="ms-2">
                        @csrf
                        <button type="submit" class="btn btn-primary">Odhlásit se</button>
                    </form>
                </div>
                @endauth
            </div>
        </div>
    </nav>

    @yield("content")
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('js/utils.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/script.js') }}"></script>

    @yield("misc_scripts")
</body>

</html>