<?php
require_once __DIR__ . '../../../config.php';
include BASE_PATH . '/includes/auth.php';
include BASE_PATH . '/includes/head.php';

$ids = json_decode($_GET['ids']);
if (empty($ids)) {
    //kontrola jestli neni id prazdny
    header("Location: /sem/u?checkout=4");
}


require_once BASE_PATH . '/db/db.class.php';
require_once BASE_PATH . '/includes/reservation/reservation.class.php';
$db = new db();
$reservation = new reservation();

$reservations = [];
foreach ($ids as $id) {
    $res = $db->getMyReservation($_SESSION['iduser'], htmlspecialchars($id));
    array_push($reservations, $res);
}

?>



<title>Potvrzení rezervace</title>
</head>

<body>

    <?php include BASE_PATH . '/includes/header.php' ?>


    <main>
        <div class="container mt-4">
            <div class="row justify-content-center px-lg-5">
                <section class="col-12 row p-0 mb-4 column-gap-3">
                    <div class="col-12 p-0 mb-5">
                        <h2>Tvoje rezervace</h2>
                    </div>
                    <?php echo $reservation->getCheckoutReservations($reservations); ?>

                    <div class="col-12 text-end mt-5">
                        <h3>Celková cena: <span id="price"><?php echo $reservation->getTotalPrice($ids); ?></span> Kč</h3>
                        <p class="mb-1">V případě ověření se, prosím, prokazujte občanským průkazem.</p>
                        <a class="btn btn-warning" href="./u?checkout=1">Zpět na přehled</a>
                    </div>


                </section>

            </div>
        </div>



        <?php include BASE_PATH . '/includes/footer.php'; ?>