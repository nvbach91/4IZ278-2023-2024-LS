<?php
require_once __DIR__ . '../../config.php';
include BASE_PATH . '/includes/authAdmin.php';
include BASE_PATH . '/includes/head.php';
require_once BASE_PATH . '/db/db.class.php';
require_once BASE_PATH . '/includes/reservation/reservation.class.php';
$db = new db();
$reservation = new reservation();

$idfield = htmlspecialchars($_GET["idfield"]);
$_SESSION['idfield'] = $idfield;
if (empty($idfield)) {
    header('Location: /sem/admin');
    exit();
}
$field = $db->getField($idfield);
$_SESSION['price'] = $field->price;
?>



<title>Rezervace <?php echo $field->name; ?></title>
</head>

<body>

    <?php include BASE_PATH . '/includes/header.php' ?>


    <main>
        <span id="price" class="visually-hidden">0</span>

        <div class="container mt-4">
            <div class="row justify-content-center px-lg-5">
                <section class="col-12 row p-0 mb-4 column-gap-3">
                    <?php include BASE_PATH . '/includes/fieldBody.php' ?>

                    <div class="row mt-5 p-0 mx-0">
                        <div class="col-6 p-0">
                            <button class="btn btn-warning" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSport" aria-expanded="false" aria-controls="collapseSport" onclick="getSports('<?php echo $idfield; ?>');">
                                Upravit sporty
                            </button>
                            <button class="btn btn-warning" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                Upravit halu
                            </button>
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete">Smazat halu</button>
                        </div>
                        <div class="col-6 text-end p-0">
                            <button onclick="confirmReservation()" class="btn btn-success disabled" id="confirm-button">Rezervace</button>
                        </div>

                        <div class="collapse p-0 mt-3" id="collapseSport">
                            <div class="border row p-3 gap-3 rounded-2" id="edit-sports">
                            </div>
                        </div>
                        <div class="collapse p-0 mt-3" id="collapseExample">
                            <div class="card card-body">
                                <?php include BASE_PATH . '/admin/editForm.php' ?>

                            </div>
                        </div>

                    </div>
                    <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="deleteModalLabel">Opravdu chcete smazat halu?</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Ne</button>
                                    <form action="../sem/admin/deleteField.php" method="post" id="form-del-field">
                                        <input type="hidden" name="idField" value="<?php echo $idfield; ?>">
                                        <button type="submit" class="btn btn-danger">Ano, smazat</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>



                </section>

            </div>
        </div>
        <?php include BASE_PATH . '/includes/footer.php'; ?>