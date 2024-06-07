<?php
session_start();
require __DIR__ . '/include/profile-navigation.php';
require_once __DIR__ . '/db/OrdersDB.php';
require_once __DIR__ . '/db/ShippingMethodsDB.php';
require_once __DIR__ . '/db/PaymentMethodsDB.php';

if (!isset($_SESSION['user_id'])) {
    echo "Nemáte oprávnění přistupovat na tuto stránku.";
    exit();
}

$ordersDB = new OrdersDB();
$shippingMethodsDB = new ShippingMethodsDB();
$paymentMethodsDB = new PaymentMethodsDB();
$orders = $ordersDB->findByUserId($_SESSION['user_id']);
?>

<div class="container mt-5">
    <h2>Moje objednávky</h2>
    <?php if (count($orders) > 0): ?>
        <?php foreach ($orders as $order): ?>
            <div class="card mb-4">
                <div class="card-header">
                    Objednávka č. <?php echo htmlspecialchars($order['order_id'], ENT_QUOTES, 'UTF-8'); ?>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Stav: <?php echo htmlspecialchars($order['status'], ENT_QUOTES, 'UTF-8'); ?></h5>
                    <p class="card-text">Datum: <?php echo htmlspecialchars($order['created_at'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <h6>Položky:</h6>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Název</th>
                                <th>Množství</th>
                                <th>Cena za kus</th>
                                <th>Cena</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $orderItems = $ordersDB->findOrderItems($order['order_id']);
                            $totalPrice = 0;
                            foreach ($orderItems as $item):
                                $itemTotal = $item['quantity'] * $item['price'];
                                $totalPrice += $itemTotal;
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($item['quantity'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($item['price'], ENT_QUOTES, 'UTF-8'); ?> Kč</td>
                                    <td><?php echo htmlspecialchars($itemTotal, ENT_QUOTES, 'UTF-8'); ?> Kč</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php
                    $shippingMethod = $shippingMethodsDB->findById($order['shipping_method_id']);
                    $shippingPrice = $shippingMethod ? $shippingMethod['price'] : 0;
                    $totalPrice += $shippingPrice;

                    $paymentMethod = $paymentMethodsDB->findById($order['payment_method_id']);
                    $paymentFee = $paymentMethod ? $paymentMethod['fee'] : 0;
                    $totalPrice += $paymentFee;
                    ?>
                    <p><strong>Doprava:</strong> <?php echo htmlspecialchars($shippingMethod['name'], ENT_QUOTES, 'UTF-8'); ?> - <?php echo htmlspecialchars($shippingPrice, ENT_QUOTES, 'UTF-8'); ?> Kč</p>
                    <p><strong>Poplatek za platbu:</strong> <?php echo htmlspecialchars($paymentMethod['name'], ENT_QUOTES, 'UTF-8'); ?> - <?php echo htmlspecialchars($paymentFee, ENT_QUOTES, 'UTF-8'); ?> Kč</p>
                    <h5><strong>Celková cena:</strong> <?php echo htmlspecialchars($totalPrice, ENT_QUOTES, 'UTF-8'); ?> Kč</h5>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Nemáte žádné objednávky.</p>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/include/footer.php'; ?>
