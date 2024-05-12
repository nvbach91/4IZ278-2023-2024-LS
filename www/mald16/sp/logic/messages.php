<?php session_status() === PHP_SESSION_NONE ? session_start() : null; ?>

<?php

$messages = [
    1 => "Registrace byla úspěšná.",
    2 => "Přihlášení bylo úspěšné.",
    3 => "Nepodařilo se načíst skladbu.",
    4 => "Nejdřív se prosím přihlaš.",
    5 => "Nepodařilo se načíst organizaci.",
    6 => "Nepodařilo se načíst službu organizace.",
    7 => "Při odebírání služby organizace nastala chyba v komunikaci s databází.",
    8 => "Skladba byla úspěšně vytvořena.",
    9 => "Skladba byla úspěšně upravena.",
    10 => "Nepodařilo se upravit roli uživatele.",
    11 => "Při úpravě role uživatele nastala chyba v komunikaci s databází.",
    12 => "Při vytváření skladby nastala chyba v komunikaci s databází.",
    13 => "Nepodařilo se vytvořit skladbu.",
    14 => "Nepodařilo se načíst uživatele.",
    15 => "Při odebírání uživatele z organizace nastala chyba v komunikaci s databází.",
    16 => "Odebrání uživatele z organizace proběhlo úspěšně.",
    17 => "Nepodařilo se načíst uživatele.",
    19 => "Organizace byla úspěšně vytvořena.",
    20 => "Nastavení profilu úspěšně změněno.",
    21 => "Při úpravě nastavení profilu došlo k chybě.",


];

function unsetSessionVariable($type) {
    switch ($type) {
        case "info":
            unset($_SESSION["im"]);
            break;
        case "error":
            unset($_SESSION["em"]);
            break;
        case "success":
            unset($_SESSION["sm"]);
            break;
    }
}
?>

<?php if (isset($_SESSION["im"]) && !empty($_SESSION["im"])) : ?>
    <div class="alert alert-warning" role="alert">
        <strong><?php echo $messages[$_SESSION["im"]]; ?></strong>
    </div>
    <?php unsetSessionVariable("info"); ?>
<?php endif ?>

<?php if (isset($_SESSION["sm"]) && !empty($_SESSION["sm"])) : ?>
    <div class="alert alert-success" role="alert">
        <strong><?php echo $messages[$_SESSION["sm"]]; ?></strong>
    </div>
    <?php unsetSessionVariable("success"); ?>
<?php endif ?>

<?php if (isset($_SESSION["em"]) && !empty($_SESSION["em"])) : ?>
    <div class="alert alert-danger" role="alert">
        <strong><?php echo $messages[$_SESSION["em"]]; ?></strong>
    </div>
    <?php unsetSessionVariable("error"); ?>
<?php endif ?>