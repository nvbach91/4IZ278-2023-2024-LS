<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moje Hala - pojď sportovat!</title>
    <?php include 'includes/bth.php' ?>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <nav class="navbar bg-grey">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">MOJE HALA</a>
                <form class="d-flex" role="search">
                    <a href="./signup" class="btn btn-warning me-2">Registrovat se</a>
                    <a href="./login" class="btn btn-success">Přihlásit se</a>
                </form>
            </div>
        </nav>
    </header>

    <main>
        <div class="container mt-4">
            <div class="row justify-content-center px-lg-5">
                <div id="carouselExampleCaptions" class="carousel slide mb-2" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="imgs/tenis.webp" class="d-block w-100" alt="Sportoviště na tenis">
                            <div class="gradient-overlay"></div>
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Hala 1</h5>
                                <p>Profesionální tenisové kurty.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="imgs/florbal.webp" class="d-block w-100" alt="Sportoviště na Volejbal">
                            <div class="gradient-overlay"></div>
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Hala 2</h5>
                                <p>Florbal se u nás hraje skvěle!</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="imgs/basket.webp" class="d-block w-100" alt="Sportoviště na basketball">
                            <div class="gradient-overlay"></div>
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Hala 4</h5>
                                <p>Skvělý povrch jako dělaný pro basketball.</p>
                            </div>
                        </div>


                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <h1 class="text-center">Multifunkční sportovní hala na Praze 4</h1>
            </div>
        </div>

    </main>

</body>
<?php include 'includes/btf.php' ?>

</html>