<?php session_status() === PHP_SESSION_NONE ? session_start() : null; ?>
<?php require "./logic/display-errors.php" ?>

<?php $pageName = "Členové organizace" ?>


<?php
require_once "./logic/allowed-users.php";
allowedUsers(["logged-in"]);
?>
<?php require_once "./logic/email.php"; ?>
<?php require_once "./logic/validate.php"; ?>

<?php require_once "./db/Organization.php"; ?>
<?php require_once "./db/User.php"; ?>
<?php require_once "./db/Song.php"; ?>

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

$orgClients = $Organization->getUsers(1);
$orgProducers = $Organization->getUsers(2);

$orgServices = $Organization->getServices();
?>

<?php include "./inc/head.php" ?>
<h1>Skladby v organizaci</h1>
<a href="edit-org.php?oid=<?php echo $existingOrg["org_id"] ?>" style="text-decoration: none">
    <h6 class="text-muted"><?php echo $existingOrg["org_name"] ?></h6>
</a>
<hr>
<div class="btn-group">
    <a href="edit-org.php?oid=<?php echo $existingOrg["org_id"] ?>" class="btn btn-outline-primary">Úprava organizace 🏢 <?php if (count($orgServices) == 0) : ?><span class="badge bg-danger">!</span><?php endif ?></a>
    <a href="create-song.php?oid=<?php echo $existingOrg["org_id"] ?>" class="btn btn-outline-primary">Nová skladba 🎸</a>
    <a href="view-org-songs.php?oid=<?php echo $existingOrg["org_id"] ?>&view=pending" class="btn btn-outline-primary active">Skladby v organizaci 🎶</a>
    <a href="edit-org-users.php?oid=<?php echo $existingOrg["org_id"] ?>" class="btn btn-outline-primary">Členové organizace 👥 <?php if (count($orgClients + $orgProducers) == 0) : ?><span class="badge bg-danger">!</span><?php endif ?></a>
</div>
<br>
<br>
<?php require __DIR__ . "/logic/errors.php" ?>
<?php require "./logic/messages.php"; ?>
<?php if ($AccessUser->getRole() == 3) : ?>
    <div style="display: flex; justify-content: center">
        <nav>
            <ul class="pagination">
                <li class="page-item"><a class="page-link <?php echo (isset($_GET["view"]) && $_GET["view"] == "finished") ? "" : "active" ?>" href="<?php echo $_SERVER['REQUEST_URI'] ?>&view=pending">Rozpracované 🛠️</a></li>
                <li class="page-item"><a class="page-link <?php echo (isset($_GET["view"]) && $_GET["view"] == "finished") ? "active" : "" ?>" href="<?php echo $_SERVER['REQUEST_URI'] ?>&view=finished">Hotové ✅</a></li>
            </ul>
        </nav>
    </div>
<?php endif ?>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Název skladby</th>
            <th scope="col">Producent</th>
            <th scope="col">Klient</th>
            <?php if (($AccessUser->getRole() == 3) && isset($_GET["view"]) && $_GET["view"] != "finished") : ?><th scope="col">Progres</th><?php endif ?>
        </tr>
    </thead>
    <tbody>
        <?php if (count($orgSongs) != 0) : ?>
            <?php foreach ($orgSongs as $song) : ?>
                <?php

                $SongObj = new Song($song["song_id"]);
                $songServices = $SongObj->getServices();
                $servicesCount = count($songServices) * 2;
                $servicesProgress = 0;

                $songIsDone = false;

                foreach ($songServices as $service) {
                    if ($service["state"] == 2) {
                        $songIsDone = true;
                    }
                    $servicesProgress += $service["state"];
                }

                if ($songIsDone && isset($_GET["view"]) && $_GET["view"] != "finished") {
                    continue;
                }

                if (!$songIsDone && isset($_GET["view"]) && $_GET["view"] == "finished") {
                    continue;
                }

                $servicesProgress = $servicesCount == 0 ? 0 : round($servicesProgress / $servicesCount * 100);
                ?>
                <tr>
                    <td><a href="edit-song.php?sid=<?php echo $song['song_id']; ?>"><?php echo $song["name"] ?></a></td>
                    <td><?php echo $song["producer_name"] == "" ? "<i>nezvolen</i>" : $song["producer_name"] ?> <?php echo $song["producer_name"] == $_SESSION["user-name"] ? "(ty)" : "" ?></td>
                    <td>
                        <?php echo $song["client_name"] ?>
                    </td>
                    <?php if (($AccessUser->getRole() == 3) && (isset($_GET["view"]) && $_GET["view"] != "finished")) : ?><td><?php echo $servicesProgress . " %" ?></td><?php endif ?>
                </tr>
            <?php endforeach ?>
        <?php else : ?>
            <tr>
                <td colspan="4" style="text-align: center;" class="text-muted">
                    Organizace nemá zatím žádné skladby.
                </td>
            </tr>
        <?php endif ?>
    </tbody>
</table>
<?php include "./inc/foot.php" ?>