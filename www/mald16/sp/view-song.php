<?php session_status() === PHP_SESSION_NONE ? session_start() : null; ?>
<?php require "./logic/display-errors.php" ?>

<?php $pageName = "Zobrazení skladby" ?>

<?php
require_once "./logic/allowed-users.php";
allowedUsers(["logged-in"]);
?>
<?php require_once "./logic/validate.php"; ?>
<?php require_once "./db/Song.php"; ?>
<?php require_once "./db/Organization.php"; ?>
<?php require_once "./db/User.php"; ?>

<?php

function getServiceStateName($stateNum) {
    switch ($stateNum) {
        case 0:
            return "❌ Ještě jsme nezačali";
        case 1:
            return "🛠️ Už na tom makáme";
        case 2:
            return "✅ Hotovo";
    }
}

function formatDate($date) {
    $dateTime = new DateTime($date);
    $formattedDate = $dateTime->format('j. n. Y');

    return $formattedDate;
}

function getProgress($services) {
    $max = count($services) * 2;
    $done = 0;
    foreach ($services as $service) {
        $done += $service["state"];
    }
    return ($done / $max) * 100 + 10;
}

?>

<?php

$Song = new Song($_GET["sid"]);
$existingSong = $Song->getSong();

$Organization = new Organization($Song->orgId);
$existingOrganization = $Organization->getOrganization();

$User = new User($_SESSION["user-email"], $Organization->orgId);

$services = $Song->getServices();

$producerName = $Organization::getUserName($Song->producer);

if (!isset($_GET["sid"]) || empty($_GET["sid"]) || !$existingSong || !$existingOrganization) {
    $_SESSION["em"] = 3;
    header('Location: ' . "./index.php");
    exit();
}
?>

<?php include "./inc/head.php" ?>
<h1><?php echo $Song->name ?></h1>
<h6 class="text-muted">Producent: <?php echo $producerName == "" ? "<i>nezvolen</i>" : $producerName ?> &#183; <?php echo $Organization->orgName ?></h6>
<hr>
<?php require "./logic/errors.php"; ?>
<?php require "./logic/messages.php"; ?>
<div class="progress">
    <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?php echo getProgress($services) ?>%"></div>
</div>
<br>
<div style="display: flex; flex-wrap: wrap">
    <?php foreach ($services as $service) : ?>
        <div class="card" style="width: 18rem; margin: 10px 10px 10px 0;">
            <div class="card-body">
                <h5 class="card-title"><?php echo $service["service_name"] ?></h5>
                <h6 class="card-subtitle mb-4 mt-2 text-muted"><?php echo getServiceStateName($service["state"]) ?></h6>
                <sub class="card-subtitle mb-2 text-muted"><?php echo $service["finish_date"] == null ? "" : "Změněno: " . formatDate($service["finish_date"]) ?></sub>
            </div>
        </div>
    <?php endforeach ?>
</div>
<?php include "./inc/foot.php" ?>