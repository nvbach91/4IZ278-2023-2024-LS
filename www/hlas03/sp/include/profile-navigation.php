<?php require __DIR__ . '/header.php'; ?>

<div class="container mt-5">
    <h2>Můj profil</h2>
    <ul class="nav nav-tabs" id="profileTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'active' : ''; ?>" href="./profile.php">Základní údaje</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'address.php' ? 'active' : ''; ?>" href="./address.php">Doručovací adresa</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'orders.php' ? 'active' : ''; ?>" href="./orders.php">Objednávky</a>
        </li>
    </ul>
</div>

