<?php require __DIR__ . '/include/profile-navigation.php'; ?>
<?php

require_once __DIR__ . '/db/AddressDB.php';

$addressDB = new AddressDB();
$address = $addressDB->findByUserId((int)$_SESSION['user_id']);
?>

<div class="container mt-5">
    <div id="address-info" class="mt-5">
        <h3>Doručovací adresa</h3>
        <?php if ($address): ?>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th scope="row">Ulice</th>
                        <td><?php echo htmlspecialchars($address['street'], ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Město</th>
                        <td><?php echo htmlspecialchars($address['city'], ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">PSČ</th>
                        <td><?php echo htmlspecialchars($address['zip_code'], ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Země</th>
                        <td><?php echo htmlspecialchars($address['country'], ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                </tbody>
            </table>
            <a href="./address-edit.php" class="btn btn-primary">Upravit adresu</a>
        <?php else: ?>
            <p>Nemáte nastavenu žádnou adresu.</p>
            <a href="./address-edit.php" class="btn btn-primary">Přidat adresu</a>
        <?php endif; ?>
    </div>
</div>

<?php require __DIR__ . '/include/footer.php'; ?>
