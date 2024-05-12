<?php //TODO fill nav based on user privilege dynamically + set sm number based on count
?>

<body>
    <header class="container-fluid bg-color-primary">
        <div class="row header-height">
            <div class="h-sm-120 col-sm-8 p-3  order-sm-1 d-flex justify-content-center">
                <a href="./index.php">
                    <img src="./images/logo_bottom_white.svg" alt="Ortotika logo" class="grow-img">
                </a>
            </div>
            <div class="h-sm-fit-content col-sm p-0  order-sm-0 d-sm-flex align-items-sm-end justify-content-sm-start">
                <a class="btn small-menu-centered-item  d-flex justify-content-center align-items-center" href="#" role="button" data-bs-toggle="collapse" data-bs-target="#navbarItems" aria-expanded="false">
                    <i class='fas fa-bars fa-2x p-1' style='color:#ffffff'></i>
                    <div class="d-none d-sm-flex text-uppercase text-white">
                        menu
                    </div>
                </a>
            </div>
            <div class="col-sm p-0  order-sm-2 d-none d-sm-flex align-items-sm-end justify-content-sm-end">
                <div class="btn-group p-0 ">
                    <div class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class='fas fa-user-circle fa-3x' style='color:#ffffff'></i>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <!-- change dynamically when user is logged in -->
                        <li class="dropdown-item">Přihlásit se</li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <main class="bg-dark-subtle p-2 pt-0">
        <div class="container-fluid ps-1 pe-1">
            <nav class="collapse row row-cols-1 row-cols-sm-4 text-uppercase text-center" id="navbarItems">
                <div class="col col-sm-4 p-3">kalendář</div>
                <div class="col col-sm-4 p-3">moje termíny</div>
                <div class="col col-sm-4 p-3">změna údajů</div>
                <div class="col p-3 d-sm-none">odhlásit se</div>
            </nav>
        </div>