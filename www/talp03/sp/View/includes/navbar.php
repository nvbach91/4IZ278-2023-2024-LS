<?php 



?>

<nav class="navbar">
        <div class="container">
            <img class="logo" src="./img/logo2.jpg" alt="logo">
            <a class="navbar-brand" href="index.php">Furniture</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-options" id="navbarResponsive">
                <ul class="navbar-list">
                    <li class="navbar-item">
                        <a class="nav-link" href="index.php">Home
                            <span class="sr-only"></span>
                        </a>
                    </li>
                    <?php if (isset($_COOKIE['email'])) { ?>
                        <li class="navbar-item">
                            <a class="nav-link" href="cart.php">Cart</a>
                        </li>
                        <li class="navbar-item">
                            <a class="nav-link" href="../Controller/logout.php">Logout</a>
                        </li>
                    <?php } else { ?>
                        <li class="navbar-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li class="navbar-item">
                            <a class="nav-link" href="register.php">Register</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>