<?php
require_once __DIR__ . '../../config.php';
include BASE_PATH . '/includes/authAdmin.php';
require_once BASE_PATH . '/includes/head.php';
require_once BASE_PATH . '/includes/reservation/reservation.class.php';
$reservation = new reservation();
?>
<title>Přehled | MOJE HALA</title>
</head>

<body>

    <?php include BASE_PATH . '/includes/header.php'; ?>


    <main>
        <div class="container mt-4">
            <div class="row justify-content-center px-lg-5">


                <?php
                include BASE_PATH . '/includes/logs.php';
                include BASE_PATH . '/includes/myReservationsBody.php';
                include BASE_PATH . '/includes/newReservationBody.php';
                include BASE_PATH . '/includes/adminStuffBody.php';
                ?>


            </div>
        </div>

        <?php

        include BASE_PATH . '/includes/footer.php';
        ?>