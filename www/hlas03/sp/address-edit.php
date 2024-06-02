<?php require __DIR__ . '/include/header.php'; ?>
<?php

require_once __DIR__ . '/db/AddressDB.php';
require_once __DIR__ . '/components/AddressValidator.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $street = $_POST['street'];
    $city = $_POST['city'];
    $zip_code = $_POST['zip_code'];
    $country = $_POST['country'];
    $user_id = $_SESSION['user_id'];

    $validator = new AddressValidator();
    $errors = $validator->validate($street, $city, $zip_code, $country);

    if (empty($errors)) {
        $addressDB = new AddressDB();
        $address = $addressDB->findByUserId($user_id);

        if ($address) {
            // Aktualizace adresy
            $result = $addressDB->update($address['address_id'], $street, $city, $zip_code, $country);
        } else {
            // Vytvoření nové adresy
            $result = $addressDB->create($street, $city, $zip_code, $country, $user_id);
        }

        if ($result) {
            header('Location: profile.php');
            exit;
        } else {
            $errors[] = "Aktualizace adresy selhala.";
        }
    }
}
?>

<div class="container mt-5">
    <h2>Upravit adresu</h2>
    <form action="address-edit" method="post">
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div class="form-group">
            <label for="street">Ulice:</label>
            <input type="text" class="form-control" id="street" name="street" required>
        </div>
        <div class="form-group">
            <label for="city">Město:</label>
            <input type="text" class="form-control" id="city" name="city" required>
        </div>
        <div class="form-group">
            <label for="zip_code">PSČ:</label>
            <input type="text" class="form-control" id="zip_code" name="zip_code" required>
        </div>
        <div class="form-group">
            <label for="country">Země:</label>
            <input type="text" class="form-control" id="country" name="country" required>
        </div>
        <button type="submit" class="btn btn-primary">Uložit změny</button>
    </form>
</div>

<?php require __DIR__ . '/include/footer.php'; ?>
