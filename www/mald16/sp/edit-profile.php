<?php session_status() === PHP_SESSION_NONE ? session_start() : null; ?>

<?php require_once "./logic/allowed-users.php"; ?>
<?php require_once "./db/User.php"; ?>
<?php require_once "./logic/display-errors.php"; ?>
<?php

if (!isset($_SESSION["user-email"]) || empty($_SESSION["user-email"])) {
    header('Location: ' . "login.php");
    exit();
}

$User = new User($_SESSION["user-email"]);

$existingUser = $User->getUser();


if (isset($_POST) && !empty($_POST)) {
    $name = $_POST["name"];
    $notifOptIn = isset($_POST["notif-opt-in"]) ? 1 : 0;

    $success = $User->updateUser($notifOptIn);

    if ($success) {
        $_SESSION["sm"] = 20;
        header('Location: ' . "edit-profile.php");
        exit();
    } else {
        $_SESSION["em"] = 21;
        header('Location: ' . "edit-profile.php");
        exit();
    }
}
?>

<?php include "./inc/head.php" ?>
<h1>Úprava profilu</h1>
<hr>
<?php require "./logic/errors.php"; ?>
<?php require "./logic/messages.php"; ?>
<form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
    <div class="mb-3">
        <label class="form-label">Jméno</label>
        <input type="text" class="form-control" placeholder="Michael Jackson" name="name" value="<?php echo $existingUser["name"] ?>">
    </div>
    <div class="mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" name="notif-opt-in" <?php echo $existingUser["notif_opt_in"] != null ? ($existingUser["notif_opt_in"] == 1 ? "checked" : "") : ""  ?>>
            <label class="form-check-label">
                Chci odebírat e-mailové notifikace
            </label>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Upravit profil</button>
</form>
<?php include "./inc/foot.php" ?>