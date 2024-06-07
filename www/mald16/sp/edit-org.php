<?php session_status() === PHP_SESSION_NONE ? session_start() : null; ?>
<?php require "./logic/display-errors.php" ?>

<?php $pageName = "Úprava organizace" ?>


<?php
require_once "./logic/allowed-users.php";
allowedUsers(["logged-in"]);
?>
<?php require_once "./logic/email.php"; ?>
<?php require_once "./logic/validate.php"; ?>

<?php require_once "./db/Organization.php"; ?>
<?php require_once "./db/User.php"; ?>

<?php

$Organization = new Organization($_GET["oid"]);
$existingOrg = $Organization->getOrganization();

$AccessUser = new User($_SESSION["user-email"], $_GET["oid"]); // an user, who is trying to make this change
if ($AccessUser->getUserInOrg() == false) {
    $_SESSION["em"] = 25;
    header('Location: ' . "./index.php");
    exit();
}

if (!isset($_GET["oid"]) || empty($_GET["oid"]) || !$existingOrg) {
    $_SESSION["em"] = 5;
    header('Location: ' . "./index.php");
    exit();
} else if ($AccessUser->getRole() == 1) {
    $_SESSION["em"] = 25;
    header('Location: ' . "./index.php");
    exit();
}

$orgSongs = $Organization->getSongs();

$orgServices = $Organization->getServices();

$orgClients = $Organization->getUsers(1);
$orgProducers = $Organization->getUsers(2);

if (isset($_POST["service-input"]) && !empty($_POST["service-input"])) {
    $servName = htmlspecialchars(trim($_POST["service-input"]));
    $errors = [];

    if (!validateStr($servName)) {
        array_push($errors, "Název služby nesmí být prázdný nebo delší než 255 znaků.");
    }

    $success = false;

    if (empty($errors)) {
        $success = $Organization->addService($servName);

        if ($success) {
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit();
        }
    }
} else if (isset($_POST["name"]) && !empty($_POST["name"])) {
    $name = htmlspecialchars(trim($_POST["name"]));
    $errors = [];

    if (!validateStr($name)) {
        array_push($errors, "Název organizace nesmí být prázdný nebo delší než 255 znaků.");
    }

    $success = false;

    if (empty($errors)) {
        $Organization->updateOrganizationName($name);
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit();
    }
}

?>

<?php include "./inc/head.php" ?>
<h1>Úprava organizace</h1>
<h6 class="text-muted"><?php echo $existingOrg["org_name"] ?></h6>
<hr>
<div class="btn-group">
    <a href="edit-org.php?oid=<?php echo $existingOrg["org_id"] ?>" class="btn btn-primary active">Úprava organizace 🏢 <?php if (count($orgServices) == 0) : ?><span class="badge bg-danger">!</span><?php endif ?></a>
    <a href="create-song.php?oid=<?php echo $existingOrg["org_id"] ?>" class="btn btn-outline-primary">Nová skladba 🎸</a>
    <a href="view-org-songs.php?oid=<?php echo $existingOrg["org_id"] ?>&view=pending" class="btn btn-outline-primary">Skladby v organizaci 🎶</a>
    <a href="edit-org-users.php?oid=<?php echo $existingOrg["org_id"] ?>" class="btn btn-outline-primary">Členové organizace 👥 <?php if (count($orgClients + $orgProducers) == 0) : ?><span class="badge bg-danger">!</span><?php endif ?></a>
    <?php if (count($orgSongs) == 0 && $AccessUser->getRole() == 3) : ?>
        <a href="delete-org.php?oid=<?php echo $existingOrg["org_id"] ?>" class="btn btn-outline-danger">Odebrat organizaci 🗑️</a>
    <?php endif ?>
</div>
<br>
<br>
<?php require __DIR__ . "/logic/errors.php" ?>
<?php require "./logic/messages.php"; ?>
<form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
    <div class="mb-3">
        <label class="form-label">Název organizace</label>
        <div class="input-group ">

            <input type="text" class="form-control" placeholder="Abbey Road Studios" name="name" value="<?php echo !empty($_POST["name"]) ? $_POST["name"] : $existingOrg["org_name"] ?>">
            <button class="btn btn-outline-secondary" type="submit">Upravit</button>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Služby</label><br>
        <div class="services-wrapper">
            <?php foreach ($orgServices as $orgServ) : ?>
                <div class="service">
                    <a class="btn-delete" href="delete-service.php?sid=<?php echo $orgServ["service_id"] ?>&oid=<?php echo $orgServ["org_id"] ?>">
                        <div class="btn-delete-cross"></div>
                        <div class="btn-delete-cross"></div>
                    </a>
                    <?php echo $orgServ["service_name"] ?>
                </div>
            <?php endforeach ?>
            <div class="input-group service-input">
                <input type="text" class="form-control" placeholder="Dělání kafe" name="service-input">
                <button class="btn btn-outline-secondary" type="submit">Přidat</button>
            </div>
        </div>
        <?php if (count($orgServices) != 0) : ?>
            <div class="form-text">Buď obezřetný! Odstranění služby povede k odstranění této služby i u všech skladeb v této organizaci.</div>
        <?php else : ?>
            <div class="form-text text-danger">Přidej alespoň 1 službu.</div>
        <?php endif ?>
    </div>
</form>
<script src="./scripts/edit-role.js"></script>
<?php include "./inc/foot.php" ?>