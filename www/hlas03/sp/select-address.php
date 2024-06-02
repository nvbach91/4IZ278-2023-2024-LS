<?php
session_start();
require __DIR__ . '/include/header.php';
require_once __DIR__ . '/validators/AddressValidator.php';
require_once __DIR__ . '/db/AddressDB.php';

$errors = [];
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

$addresses = [];
if ($user_id) {
    $addressDB = new AddressDB();
    $address = $addressDB->findByUserId($user_id);
    if ($address) {
        $addresses[] = $address;
        $_SESSION['addresses'] = $addresses;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($user_id && isset($_POST['address'])) {
        // Uložení vybrané adresy do session
        $_SESSION['selected_address'] = $addresses[$_POST['address']];
        header('Location: select-shipping');
        exit;
    } else {
        $street = $_POST['street'];
        $city = $_POST['city'];
        $zip_code = $_POST['zip_code'];
        $country = $_POST['country'];

        $validator = new AddressValidator();
        $errors = $validator->validate($street, $city, $zip_code, $country);

        if (empty($errors)) {
            $new_address = [
                'street' => $street,
                'city' => $city,
                'zip_code' => $zip_code,
                'country' => $country,
            ];

            // Přidáme novou adresu do session
            $_SESSION['addresses'][] = $new_address;
            $_SESSION['selected_address'] = $new_address;
            header('Location: select-shipping');
            exit;
        }
    }
}
?>

<div class="container mt-5">
    <h2>Vyberte adresu</h2>
    <?php if ($user_id && !empty($addresses)): ?>
        <form action="select-address" method="post">
            <div class="form-group">
                <label for="address">Uložené adresy:</label>
                <select class="form-control" id="address" name="address">
                    <?php foreach ($addresses as $index => $address): ?>
                        <option value="<?php echo htmlspecialchars($index); ?>">
                            <?php echo htmlspecialchars($address['street'] . ', ' . $address['city'] . ', ' . $address['zip_code'] . ', ' . $address['country']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Pokračovat s vybranou adresou</button>
        </form>
        <hr>
        <h3>Nebo přidejte novou adresu</h3>
    <?php endif; ?>
    
    <form action="select-address" method="post">
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div class="form-group">
            <label for="street">Ulice:</label>
            <input type="text" class="form-control" id="street" name="street" value="<?php echo htmlspecialchars($street ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label for="city">Město:</label>
            <input type="text" class="form-control" id="city" name="city" value="<?php echo htmlspecialchars($city ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label for="zip_code">PSČ:</label>
            <input type="text" class="form-control" id="zip_code" name="zip_code" value="<?php echo htmlspecialchars($zip_code ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label for="country">Země:</label>
            <input type="text" class="form-control" id="country" name="country" value="<?php echo htmlspecialchars($country ?? ''); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Pokračovat</button>
    </form>
</div>

<?php require __DIR__ . '/include/footer.php'; ?>
