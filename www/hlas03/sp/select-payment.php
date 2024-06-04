<?php
session_start();
require_once __DIR__ . '/db/PaymentMethodsDB.php';

$paymentMethodsDB = new PaymentMethodsDB();
$paymentMethods = $paymentMethodsDB->findAll();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selected_payment_method = filter_input(INPUT_POST, 'payment_method', FILTER_SANITIZE_NUMBER_INT);

    if ($selected_payment_method) {
        $selected_method = null;
        foreach ($paymentMethods as $method) {
            if ($method['payment_method_id'] == $selected_payment_method) {
                $selected_method = $method;
                break;
            }
        }
        if ($selected_method) {
            $_SESSION['payment_method'] = $selected_method;
            header('Location: checkout-review');
            exit;
        } else {
            $errors[] = "Neplatný způsob platby.";
        }
    } else {
        $errors[] = "Vyberte způsob platby.";
    }
}

require __DIR__ . '/include/header.php';
?>

<div class="container mt-5">
    <h2>Výběr platby</h2>
    <form action="select-payment" method="post">
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div class="form-group">
            <label for="payment_method">Zvolte způsob platby:</label>
            <div>
                <?php foreach ($paymentMethods as $method): ?>
                    <div class="card mb-3">
                        <label class="card-body d-flex align-items-center w-100 p-3 mb-0" for="payment_method_<?php echo htmlspecialchars($method['payment_method_id']); ?>">
                            <input class="form-check-input ml-2" type="radio" name="payment_method" id="payment_method_<?php echo htmlspecialchars($method['payment_method_id']); ?>" value="<?php echo htmlspecialchars($method['payment_method_id']); ?>" required>
                            <div class="ml-4 w-100 d-flex justify-content-between align-items-center">
                                <span><?php echo htmlspecialchars($method['name']); ?></span>
                                <span><?php echo htmlspecialchars($method['fee']) . ' Kč'; ?></span>
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
