<?php require_once __DIR__ . './../../db/AdvertizerDB.php'; ?>
<?php
include __DIR__ . './../../utils.php';

$advertizerDB = new AdvertizerDB;
$advertizer = $advertizerDB->findAdvertizerById($_SESSION['advertizer_id']);
$account_number = $advertizer['account_number'];
$bank_code = $advertizer['bank_code'];

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $account_number = htmlspecialchars(trim($_POST['account_number']));
    $bank_code = htmlspecialchars(trim($_POST['bank_code']));

    if (!ctype_digit($account_number)) {
        $errors[] = "Číslo účtu musí obsahovat čísla.";
    }
    if (!ctype_digit($bank_code)) {
        $errors[] = "Kód banky musí obsahovat čísla.";
    }
    if (empty($errors)) {
        $advertizerDB->updatePaymentInfo($account_number, $bank_code, $_SESSION['advertizer_id']);
    }

    if (!empty($errors)) {
        echo '<div class="alert alert-danger  gap-3">';
        foreach ($errors as $error) {
            echo '<div>' . $error . '</div>';
        }
        echo '</div>';


    }
}
?>
<div class=" container row  d-flex flex-grow-1 ">
    <div class="row d-flex flex-grow-1  ">
        <div class="col-3 text-center">
            <div class="mt-4 ">
                <a href="admin_index.php" class="btn btn-lg btn-outline-secondary"> Zpět</a>
            </div>
        </div>
        <div class="col-9 my-4 ">

            <h1 class="mb-1">Platební údaje</h1>
            <form class="row my-4" method="POST"
                  action="<?php echo $_SERVER["PHP_SELF"] ?>?id=<?php echo $id ?>" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-6">
                        <label>Číslo účtu</label>
                        <input class="form-control" name="account_number"
                               value="<?php echo htmlspecialchars(trim($account_number)); ?>">

                    </div>

                    <div class="col-6">
                        <label>Kód banky</label>
                        <input class="form-control" name="bank_code" min="0"
                               value="<?php echo htmlspecialchars(trim($bank_code)); ?>">

                    </div>

                    <button class="btn-primary btn mt-3" type="submit">Uložit</button>
                </div>
            </form>
        </div>
    </div>
