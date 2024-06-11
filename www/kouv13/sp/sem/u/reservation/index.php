<?php
require_once __DIR__ . '../../../config.php';
include BASE_PATH . '/includes/auth.php';
include BASE_PATH . '/includes/head.php';
require_once BASE_PATH . '/db/db.class.php';
require_once BASE_PATH . '/includes/reservation/reservation.class.php';
$db = new db();
$reservation = new reservation();

$idfield = htmlspecialchars($_GET["idfield"]);
if (empty($idfield)) {
    header('Location: /sem/u');
    exit();
}
$_SESSION['idfield'] = $idfield;
$field = $db->getField($idfield);
$_SESSION['price'] = $field->price;
?>



<title>Rezervace <?php echo $field->name; ?></title>
</head>

<body>

    <?php include BASE_PATH . '/includes/header.php' ?>


    <main>
        <div class="container mt-4">
            <div class="row justify-content-center px-lg-5">
                <section class="col-12 row p-0 mb-4 column-gap-3">
                    <?php include BASE_PATH . '/includes/fieldBody.php'; ?>

                    <div class="col-12 text-end mt-5">
                        <h3>Cena: <span id="price">0</span> Kč</h3>
                        <p class="mb-1">Platba probíhá na místě.</p>
                        <button onclick="confirmReservation()" class="btn btn-success disabled" id="confirm-button">Zavazující se rezervace</button>
                    </div>


                </section>

            </div>
        </div>

        <?php include BASE_PATH . '/includes/footer.php'; ?>