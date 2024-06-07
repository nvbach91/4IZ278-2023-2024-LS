<?php session_status() === PHP_SESSION_NONE ? session_start() : null; ?>
<?php require "./logic/display-errors.php" ?>
<?php $pageName = "Vytvořit organizaci" ?>
<?php
require_once "./logic/allowed-users.php";
allowedUsers(["logged-in"]);
?>
<?php require_once "./logic/validate.php"; ?>
<?php require_once "./db/Organization.php"; ?>
<?php require_once "./db/Song.php"; ?>

<?php

if (isset($_POST) && !empty($_POST)) {
    $orgName = htmlspecialchars(trim($_POST["org-name"]));

    $errors = [];

    if (!validateStr($orgName)) {
        array_push($errors, "Název organizace nesmí být prázdný nebo delší než 255 znaků.");
    }

    if (empty($errors)) {
        $returnId = Organization::createOrganization($orgName, $_SESSION["user-email"], true);

        $_SESSION["sm"] = 19;
        header('Location: ' . "./edit-org.php?oid=" . $returnId);
        exit();
    }
}

?>

<?php include "./inc/head.php" ?>
<h1>Vytvoření nové organizace</h1>
<hr>
<?php require __DIR__ . "/logic/errors.php" ?>
<?php require "./logic/messages.php"; ?>
<form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
    <div class="mb-3">
        <label class="form-label">Název organizace <span class="form-required">*</span></label>
        <input type="text" name="org-name" class="form-control" placeholder="Abbey Road Studios">
    </div>

    <button type="submit" class="btn btn-primary">Vytvořit organizaci</button>
</form>
<script src="./scripts/create-org.js"></script>
<?php include "./inc/foot.php" ?>