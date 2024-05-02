<?php

if (isset($_COOKIE['username'])) { ?>
    <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
    <li class="nav-item"><a class="nav-link" href="#!"><?php echo $_COOKIE['username']; ?></a></li>
    <li class="nav-item"><a class="nav-link" href="administration.php">Administration</a></li>
    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
<?php } else { ?>
    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
<?php }



?>