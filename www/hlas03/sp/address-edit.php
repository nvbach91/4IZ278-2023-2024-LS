<?php require __DIR__ . '/include/header.php'; ?>
<?php

require_once __DIR__ . '/db/AddressDB.php';
require_once __DIR__ . '/validators/AddressValidator.php';

$errors = [];
$address = null;
$user_id = (int)$_SESSION['user_id'];

$addressDB = new AddressDB();
$address = $addressDB->findByUserId($user_id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $street = htmlspecialchars(trim($_POST['street']), ENT_QUOTES, 'UTF-8');
    $city = htmlspecialchars(trim($_POST['city']), ENT_QUOTES, 'UTF-8');
    $zip_code = htmlspecialchars(trim($_POST['zip_code']), ENT_QUOTES, 'UTF-8');
    $country = htmlspecialchars(trim($_POST['country']), ENT_QUOTES, 'UTF-8');

    $validator = new AddressValidator();
    $errors = $validator->validate($street, $city, $zip_code, $country);

    if (empty($errors)) {
        if ($address) {
            $result = $addressDB->update($address['address_id'], $street, $city, $zip_code, $country);
        } else {
            $result = $addressDB->create($street, $city, $zip_code, $country, $user_id);
        }

        if ($result) {
            header('Location: address.php');
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
                    <p><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div class="form-group">
            <label for="street">Ulice:</label>
            <input type="text" class="form-control" id="street" name="street" value="<?php echo htmlspecialchars($address['street'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div class="form-group">
            <label for="city">Město:</label>
            <input type="text" class="form-control" id="city" name="city" value="<?php echo htmlspecialchars($address['city'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div class="form-group">
            <label for="zip_code">PSČ:</label>
            <input type="text" class="form-control" id="zip_code" name="zip_code" value="<?php echo htmlspecialchars($address['zip_code'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div class="form-group">
            <label for="country">Země:</label>
            <input type="text" class="form-control" id="country" name="country" value="<?php echo htmlspecialchars($address['country'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Uložit změny</button>
    </form>
</div>

<?php require __DIR__ . '/include/footer.php'; ?>
