<?php session_status() === PHP_SESSION_NONE ? session_start() : null; ?>
<?php require "./logic/display-errors.php" ?>

<?php $pageName = "Úprava skladby" ?>

<?php
require_once "./logic/allowed-users.php";
allowedUsers(["logged-in"]);
?>
<?php require_once "./logic/validate.php"; ?>
<?php require_once "./logic/email.php"; ?>
<?php require_once "./db/Song.php"; ?>
<?php require_once "./db/Organization.php"; ?>
<?php require_once "./db/User.php"; ?>

<?php

$Song = new Song($_GET["sid"]);
$existingSong = $Song->getSong();

$Organization = new Organization($Song->orgId);
$existingOrganization = $Organization->getOrganization();

$User = new User($_SESSION["user-email"], $Organization->orgId);
$AccessUser = new User($_SESSION["user-email"], $Song->orgId); // an user, who is trying to make this change

if ($AccessUser->getUserInOrg() == false) {
    $_SESSION["em"] = 25;
    header('Location: ' . "./index.php");
    exit();
}

$userRole = $User->getUserInOrg()["role"];

if (!isset($_GET["sid"]) || empty($_GET["sid"]) || !$existingSong || !$existingOrganization) {
    $_SESSION["em"] = 3;
    header('Location: ' . "./index.php");
    exit();
} else if ($AccessUser->getRole() == 1) {
    $_SESSION["em"] = 25;
    header('Location: ' . "./index.php");
    exit();
}

$clients = $Organization->getUsers(1);
$clientEmails = array_column($clients, 'email');

$producers = $Organization->getUsers(2);

$orgServices = $Organization->getServices();

$songServices = $Song->getServices();
$songServiceIds = array_column($songServices, 'org_service_id');


if (isset($_POST) && !empty($_POST)) {
    $name = htmlspecialchars(trim($_POST["song-name"]));
    $producer = htmlspecialchars(trim($_POST["producer"]));
    $client = htmlspecialchars(trim($_POST["client"]));

    $errors = [];
    $servicesEmpty = false;

    if (isset($_POST["services"]) && !empty($_POST["services"])) {
        $services = $_POST["services"];

        $servicesStatuses = [];

        foreach ($services as $serv) {
            $sid = "sid" . $serv;
            if (isset($_POST[$sid]) && !empty($_POST[$sid])) {
                $serviceStatus = htmlspecialchars(trim($_POST[$sid]));
                $servicesStatuses[$serv] = $serviceStatus;
            } else {
                $servicesStatuses[$serv] = 0;
            }
        }
    } else {
        $servicesEmpty = true;
        array_push($errors, "Musíš vybrat alespoň jednu službu.");
    }

    if (empty($errors)) {
        sendMail($Song->getOwnerEmail(), "editSong");
        Song::editSong($name, $producer, $client, $servicesStatuses, $_GET["sid"]);
    }
}

?>

<?php include "./inc/head.php" ?>
<h1>Úprava skladby</h1>
<h6 class="text-muted"><?php echo $Organization->orgName ?> &#183; <a class="text-muted" href="view-song.php?sid=<?php echo $_GET["sid"] ?>">Jak vidí skladbu klient?</a></h6>
<hr>
<?php require "./logic/errors.php"; ?>
<?php require "./logic/messages.php"; ?>
<form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
    <div class="mb-3">
        <label class="form-label">Název <span class="form-required">*</span></label>
        <input required type="text" class="form-control" placeholder="Africa" name="song-name" value="<?php echo $Song->name ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Producent <span class="form-required">*</span></label>
        <select class="form-select" name="producer">
            <?php foreach ($producers as $producer) : ?>
                <option value="<?php echo $producer["org_user_id"] ?>" <?php echo $producer["org_user_id"] == $Song->producer ? "selected" : "" ?>><?php echo $producer["name"] ?> <?php echo $producer["name"] == $_SESSION["user-name"] ? "(ty)" : "" ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Služby <span class="form-required">*</span></label>
        <br>
        <div style="display: flex; flex-wrap: wrap">
            <?php foreach ($orgServices as $orgServ) :
                $selectedService = in_array($orgServ["service_id"], $songServiceIds);
                $selectedState = $selectedService ? $songServices[array_search($orgServ["service_id"], $songServiceIds)]["state"] : 0;
            ?>
                <div class="card service-card">
                    <div class="card-body">
                        <h5 class="card-title" style="margin-bottom: 10px;">
                            <?php echo $orgServ["service_name"] ?>
                            <input class="form-check-input" style="margin: 2px 0 0px 10px;" type="checkbox" name="services[]" value="<?php echo $orgServ["service_id"] ?>" <?php echo $selectedService ? "checked" : "" ?>>
                        </h5>
                        <select name="<?php echo "sid" . $orgServ["service_id"] ?>" class="form-select" <?php echo $selectedService ? "" : "disabled" ?>>
                            <option value="0" <?php echo $selectedState == 0 ? "selected" : "" ?>>❌ Nepracuje se na tom</option>
                            <option value="1" <?php echo $selectedState == 1 ? "selected" : "" ?>>🛠️ Pracuje se na tom</option>
                            <option value="2" <?php echo $selectedState == 2 ? "selected" : "" ?>>✅ Hotovo</option>
                        </select>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <div class="form-text">Přidávej a odebírej služby u skladby. Můžeš také zaznamenávat stav dokončení služby.</div>
    </div>

    <div class="mb-3">
        <label class="form-label">Klient <span class="form-required">*</span></label>
        <?php if (in_array($_SESSION["user-email"], $clientEmails)) : ?>
            <select class="form-select" name="client" disabled>
                <option selected>
                    <?php echo $_SESSION["user-name"] ?> (ty)
                </option>
            </select>
        <?php else : ?>
            <select class="form-select" name="client">
                <?php foreach ($clients as $cli) : ?>
                    <option value="<?php echo $cli["org_user_id"] ?>" <?php echo $cli["org_user_id"] == $Song->client ? "selected" : "" ?>>
                        <?php echo $cli["name"] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        <?php endif; ?>
    </div>

    <button type="submit" class="btn btn-primary">Potvrdit změny</button>
    <a type="submit" href="delete-song.php?sid=<?php echo $Song->songId ?>" class="btn btn-outline-danger mx-1">Odstranit skladbu</a>
</form>
<script src="./scripts/edit-service-state.js"></script>

<?php include "./inc/foot.php" ?>