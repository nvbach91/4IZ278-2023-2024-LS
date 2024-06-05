<?php 

require_once  __DIR__ . "/../authentication/AuthUtils.php";
require_once __DIR__ . "/../config.php";

startSessionIfNone();


?>

<nav class="navbar fixed-top navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01"> 
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-brand me-xl-2">
                        <a href="<?php echo BASE_URL; ?>/" class="nav-link">BookBookGo</a>
                    </li>

                    <li class="nav-item">
                        <form class="d-flex" role="search" action="<?php echo BASE_URL; ?>/search.php" method="GET">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
                            <input style="display: none;" type="number" name="page" value="0">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </li>
                    <?php if( isAuthenticated() && isAuthorized(AuthRole::Admin)):?>
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL;?>/orders.php" class="nav-link ms-2">Orders</a>
                        </li>
                    <?php endif; ?>
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
                        <a href="<?php echo htmlspecialchars(BASE_URL . "/cart.php");?>" class="nav-link">
                            Cart
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>