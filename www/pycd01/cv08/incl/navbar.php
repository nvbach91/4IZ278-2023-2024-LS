<?php
$loggedIn = false;
if (isset($_COOKIE['name'])) {
    $loggedIn = true;
}
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="./">e-shop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="./">Home page</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./cart.php">Cart</a>
                </li>
                <?php if (!$loggedIn): ?>
                <li class="nav-item">
                    <a class="nav-link" href="./login.php">Login</a>
                </li>
                <?php endif; ?>
                <?php if ($loggedIn): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img width="32" src="./assets/avatar.svg" alt="Profile">
                    </a>
                    <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="./profile.php">My profile</a></li>
                    <li><a class="dropdown-item" href="./logout.php">Sign out</a></li>
                    </ul>
                </li>
                <?php endif; ?>
            </ul>
            
        </div>
    </div>
</nav>