<?php

$message;
if (empty($_GET['reason'])){
    Header('Location: reservation-page.php');
} else {
    switch($_GET['reason']){
        case 'admin-required': $message = 'Pro přístup do administrace potřebujete nejvyšší oprávnění!'; break;
        case 'hotel-required': $message = 'Pro tvorbu rezerevací Vám musí administrátor přiřadit oprávnění!'; break;
    }
}

?>

<div class="reservation-div">

    <h1>Přístup odepřen</h1>
    <hr class="legend">

    <p><?php echo $message; ?></p>
</div>