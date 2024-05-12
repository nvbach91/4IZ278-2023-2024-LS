<?php include '../includes/head.php';

function get_day($n)
{
    switch ($n) {
        case 0:
            $day = "po";
            break;
        case 1:
            $day = "ut";
            break;
        case 2:
            $day = "st";
            break;
        case 3:
            $day = "ct";
            break;
        case 4:
            $day = "pa";
            break;
        case 5:
            $day = "so";
            break;
        case 6:
            $day = "ne";
            break;
    }
    return $day;
}

$monday = date('d.m.', strtotime('monday this week'));
$sunday = date('d.m.', strtotime('sunday this week'));
?>



<title>Rezervace Hřiště 1</title>
</head>

<body>

    <?php include '../includes/header.php' ?>


    <main>
        <div class="container mt-4">
            <div class="row justify-content-center px-lg-5">
                <section class="col-12 row p-0 mb-4 column-gap-3">
                    <div class="col-12 p-0 mb-2">
                        <h2>HŘIŠTĚ 1</h2>
                    </div>
                    <div class="d-flex flex-column p-0 mb-5">
                        <div class="list-group list-group-radio d-flex flex-row m-0">
                            <div class="position-relative radio-container me-3 ">
                                <input class="form-check-input position-absolute top-50 end-0 me-3 fs-5" type="radio" name="listGroupRadioGrid" id="listGroupRadioGrid1" value="" checked="">
                                <label class="list-group-item py-3 pe-5" for="listGroupRadioGrid1">
                                    <strong class="fw-semibold">First radio</strong>
                                    <span class="d-block small opacity-75">With support text underneath to add more detail</span>
                                </label>
                            </div>

                            <div class="position-relative radio-container me-3">
                                <input class="form-check-input position-absolute top-50 end-0 me-3 fs-5" type="radio" name="listGroupRadioGrid" id="listGroupRadioGrid2" value="">
                                <label class="list-group-item py-3 pe-5" for="listGroupRadioGrid2">
                                    <strong class="fw-semibold">Second radio</strong>
                                    <span class="d-block small opacity-75">Some other text goes here</span>
                                </label>
                            </div>

                            <div class="position-relative radio-container me-3">
                                <input class="form-check-input position-absolute top-50 end-0 me-3 fs-5" type="radio" name="listGroupRadioGrid" id="listGroupRadioGrid3" value="">
                                <label class="list-group-item py-3 pe-5" for="listGroupRadioGrid3">
                                    <strong class="fw-semibold">Third radio</strong>
                                    <span class="d-block small opacity-75">And we end with another snippet of text</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 bg-grey rounded-3 px-4 py-2">
                        <div class="row">
                            <div class="col-12 my-3">
                                <div class="row justify-content-center">
                                    <div class="col text-end normal-text"><button class="btn btn-success arrows" disabled>
                                            < </button>
                                    </div>
                                    <div class="col">
                                        <h3 class="text-center" id="week"><?php echo $monday . ' - ' . $sunday; ?></h3>
                                    </div>
                                    <div class="col normal-text">
                                        <button class="btn btn-success arrows">
                                            > </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row justify-content-center small-text align-items-center mb-2">
                                    <div class="col normal-text">Den</div>
                                    <?php for ($i = 9; $i <= 21; $i++) : ?>
                                        <div class="col"><?php echo $i; ?>:00 - <?php echo $i; ?>:55</div>
                                    <?php endfor; ?>
                                </div>

                                <?php for ($n = 0; $n <= 6; $n++) :
                                    $day = get_day($n); ?>
                                    <div class="row justify-content-center small-text align-items-center mb-2">
                                        <div class="col normal-text"><?php echo strtoupper($day); ?></div>
                                        <?php for ($i = 9; $i <= 21; $i++) : ?>
                                            <div class="col reservation rounded-2 mx-1" id="<?php echo $day . $i; ?>" title="<?php echo strtoupper($day) . " " . $i . ":00"; ?>"></div>
                                        <?php endfor; ?>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-end mt-5">
                        <h3>Cena: 0 KČ</h3>
                        <p class="mb-1">Platba probíhá na místě.</p>
                        <a href="reserve.php" class="btn btn-success">Zavazující se rezervace</a>
                    </div>


                </section>

            </div>
        </div>

    </main>
</body>

</html>