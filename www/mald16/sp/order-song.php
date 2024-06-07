<?php session_status() === PHP_SESSION_NONE ? session_start() : null; ?>
<?php require "./logic/display-errors.php" ?>

<?php $pageName = "Objednat skladbu" ?>


<?php
require_once "./logic/allowed-users.php";
allowedUsers(["logged-in"]);
?>
<?php require_once "./logic/validate.php"; ?>
<?php require_once "./db/Organization.php"; ?>
<?php require_once "./db/Song.php"; ?>
<?php require_once "./db/User.php"; ?>

<?php

// Client is the user
$Organization = new Organization($_GET["oid"]);
$User = new User($_SESSION["user-email"], $_GET["oid"]);

$client = $User->getUserInOrg()["org_user_id"];

$existingOrganization = $Organization->getOrganization();

if (!isset($_GET["oid"]) || empty($_GET["oid"]) || !$existingOrganization || $client == null) {
    $_SESSION["em"] = 5;
    header('Location: ' . "./index.php");
    exit();
} else if ($User->getRole() == 2 || $User->getRole() == 3) {
    $_SESSION["em"] = 25;
    header('Location: ' . "./index.php");
    exit();
}

$orgServices = $Organization->getServices();

if (isset($_POST) && !empty($_POST)) {
    $name = htmlspecialchars(trim($_POST["song-name"]));

    $errors = [];
    $servicesEmpty = false;

    if (isset($_POST["services"]) && !empty($_POST["services"])) {
        $services = $_POST["services"];
    } else {
        $servicesEmpty = true;
        array_push($errors, "Musíš vybrat alespoň jednu službu.");
    }

    if (!validateStr($name)) {
        array_push($errors, "Jméno skladby nesmí být prázdné nebo delší než 255 znaků.");
    }

    if (!$servicesEmpty) {
        foreach ($services as $serv) {
            if (!validateId($serv)) {
                array_push($errors, "Služba '$serv' není validní.");
            }
        }
    }

    if (empty($errors)) {
        sendMail($_SESSION["user-email"], "createSong");
        Song::createSong($name, null, $client, $services, $existingOrganization["org_id"]);
    }
}
?>

<?php include "./inc/head.php" ?>
<h1>Objednání nové skladby</h1>
<h6 class="text-muted"><?php echo $existingOrganization["org_name"] ?></h6>
<hr>
<?php require __DIR__ . "/logic/errors.php" ?>
<?php require "./logic/messages.php"; ?>
<form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
    <div class="mb-3">
        <label class="form-label">Název skladby <span class="form-required">*</span></label>
        <input type="text" name="song-name" class="form-control" placeholder="Beat it" required value="<?php echo isset($_POST["song-name"]) ? $_POST["song-name"] : "" ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Služby <span class="form-required">*</span></label>
        <br>
        <?php if (count($orgServices) == 0) : ?>
            <p class="text-muted">Tato organizace nemá žádné služby. Přidej alespoň jednu <a href="edit-org.php?oid=<?php echo $existingOrganization["org_id"] ?>">zde</a>.</p>
        <?php endif ?>
        <?php foreach ($orgServices as $orgServ) : ?>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="services[]" value="<?php echo $orgServ["service_id"] ?>">
                <label class="form-check-label"><?php echo $orgServ["service_name"] ?></label>
            </div>
        <?php endforeach ?>
    </div>
    <button type="submit" class="btn btn-primary">Přidat skladbu</button>
</form>
<?php include "./inc/foot.php" ?>