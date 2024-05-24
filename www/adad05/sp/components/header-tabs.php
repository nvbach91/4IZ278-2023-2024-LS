<?php

$page = basename($_SERVER['PHP_SELF']);

?>

<?php if(isset($_COOKIE['email'])){ ?>
    <div class="tab tab-reservation <?php echo ($page == 'reservation-page.php') ? 'active' : ''; ?>" ><a href="reservation-page.php" class="tab-a">Hlavní stránka</a></div>
    <div class="tab <?php echo ($page == 'administration-page.php') ? 'active' : ''; ?>" ><a href="administration-page.php" class="tab-a">Administrace</a></div>
    <div class="tab <?php echo ($page == 'logout-page.php') ? 'active' : ''; ?>" ><a href="logout-page.php" class="tab-a">Odhlásit se</a></div>
<?php } else { ?>
    <div class="tab tab-reservation <?php echo ($page == 'reservation-page.php') ? 'active' : ''; ?>" ><a href="reservation-page.php" class="tab-a">Hlavní stránka</a></div>
    <div class="tab <?php echo ($page == 'registration-page.php') ? 'active' : ''; ?>" ><a href="registration-page.php" class="tab-a">Registrovat se</a></div>
    <div class="tab <?php echo ($page == 'login-page.php') ? 'active' : ''; ?>" ><a href="login-page.php" class="tab-a">Přihlásit se</a></div>
<?php } ?>