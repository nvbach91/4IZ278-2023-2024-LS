<?php

require_once '../Controller/userPrivilege.php';

?>

<nav class="navbar">
        <div class="navbar-container">
            <img class="logo" src="./img/logo2.jpg" alt="logo">
            <a class="navbar-brand" href="index.php">Furniture</a>
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
                            <?php if (isset($privilege) && $privilege['privilege'] >= 1) { ?>
                                <a href="admin-profile.php" class="nav-link">Profile</a>
                            <?php } else {?>
                                <a href="profile.php" class="nav-link">Profile</a>
                            <?php } ?>
                        <li class="navbar-item">
                            <a class="nav-link" href="../Controller/logout.php">Logout</a>
                        </li>
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