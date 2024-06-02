<?php
session_start();
require_once __DIR__ . '/db/ShippingMethodsDB.php';

$shippingMethodsDB = new ShippingMethodsDB();
$shippingMethods = $shippingMethodsDB->findAll();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selected_shipping_method = $_POST['shipping_method'] ?? null;

    if ($selected_shipping_method) {
        $selected_method = null;
        foreach ($shippingMethods as $method) {
            if ($method['shipping_methods_id'] == $selected_shipping_method) {
                $selected_method = $method;
                break;
            }
        }
        if ($selected_method) {
            $_SESSION['shipping_method'] = $selected_method;
            header('Location: select-payment');
            exit;
        } else {
            $errors[] = "Neplatný způsob dopravy.";
        }
    } else {
        $errors[] = "Vyberte způsob dopravy.";
    }
}

require __DIR__ . '/include/header.php';
?>

<div class="container mt-5">
    <h2>Výběr dopravy</h2>
    <form action="select-shipping" method="post">
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div class="form-group">
            <label for="shipping_method">Zvolte způsob dopravy:</label>
            <div>
                <?php foreach ($shippingMethods as $method): ?>
                    <div class="card mb-3">
                        <label class="card-body d-flex align-items-center w-100 p-3 mb-0" for="shipping_method_<?php echo htmlspecialchars($method['shipping_methods_id']); ?>">
                            <input class="form-check-input ml-2" type="radio" name="shipping_method" id="shipping_method_<?php echo htmlspecialchars($method['shipping_methods_id']); ?>" value="<?php echo htmlspecialchars($method['shipping_methods_id']); ?>" required>
                            <div class="ml-4 w-100 d-flex justify-content-between align-items-center">
                                <span><?php echo htmlspecialchars($method['name']); ?></span>
                                <span><?php echo htmlspecialchars($method['price'] . ' Kč'); ?></span>
                            </div>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Pokračovat</button>
    </form>
</div>

<?php require __DIR__ . '/include/footer.php'; ?>
