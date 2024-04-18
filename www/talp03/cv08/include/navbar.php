<?php 

$login = false;
if (isset($_COOKIE['name'])) {
    $login = true;
}
?>

<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="./">Start Bootstrap</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="./">
                                Home
                                <span class="sr-only"></span>
                            </a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="./cart.php">Cart</a></li>
                        <li class="nav-item"><a class="nav-link" href="./login.php">Login</a></li>
                        <?php if ($login) { ?>
                            <li class="nav-item"><a class="nav-link" href="./logout.php">Logout</a></li>
                            
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>