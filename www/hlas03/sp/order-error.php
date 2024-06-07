<?php
session_start();
require __DIR__ . '/include/header.php';

$error_message = isset($_GET['message']) ? htmlspecialchars($_GET['message'], ENT_QUOTES, 'UTF-8') : 'Došlo k chybě při zpracování vaší objednávky.';

?>

<div class="container mt-5">
    <h2>Chyba při objednávce</h2>
    <p><?php echo $error_message; ?></p>
    <a href="." class="btn btn-primary">Zpět na hlavní stránku</a>
</div>

<?php require __DIR__ . '/include/footer.php'; ?>
