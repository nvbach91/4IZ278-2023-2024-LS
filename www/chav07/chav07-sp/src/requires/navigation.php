<?php 

require_once  __DIR__ . "/../authentication/AuthUtils.php";
require_once __DIR__ . "/../config.php";

startSessionIfNone();


?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01"> 
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-brand">
                        <a href="<?php echo BASE_URL; ?>/" class="nav-link">BookBookGo</a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categories
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                    </li>
                    <li class="nav-item">
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <?php if(!isAuthenticated()):?>
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL;?>/register.php" class="nav-link">Register</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL;?>/login.php" class="nav-link">Log in</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL;?>/authentication/logout.php" class="nav-link">Log out</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Cart</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>