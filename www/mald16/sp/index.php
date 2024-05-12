<?php session_status() === PHP_SESSION_NONE ? session_start() : null; ?>

<?php include __DIR__ . "/inc/head.php"; ?>
<?php require_once __DIR__ . "/db/User.php"; ?>
<?php require_once __DIR__ . "/logic/allowed-users.php";
allowedUsers(["logged-in"]); ?>

<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$GeneralUser = new User($_SESSION["user-email"]);

$organizations = $GeneralUser->getOrganizations();

$songs = $GeneralUser->getSongs();

?>


<h1>Dashboard</h1>
<hr>
<?php require __DIR__ . "/logic/messages.php"; ?>
<br>
<h4>Tvoje organizace</h4>
<div class="text-muted">Nahrávací studia, labely a další organizace, jejichž jsi členem. <a href="create-org.php">Vytvořit novou organizaci.</a></div>
<br>
<?php if (count($organizations) == 0) : ?>
    <div class="text-muted">Nejsi členem žádné organizace.</div>
<?php else : ?>
    <div style="display: flex; flex-wrap: wrap">
        <?php foreach ($organizations as $org) :
            $OrgUser = new User($GeneralUser->email, $org["org_id"]);
        ?>
            <div class="card" style="width: 18rem; margin: 10px 10px 10px 0">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $org["org_name"] ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted">jsi <?php echo $OrgUser->getRole(true) ?></h6>
                    <div class="btn-group mt-3">
                        <a type="button" class="btn btn-primary" href="create-song.php?oid=<?php echo $org["org_id"] ?>">Nová skladba</a>
                        <?php if ($org["role"] == 2 || $org["role"] == 3) : ?>
                            <button class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">
                                Úpravy
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="edit-org.php?oid=<?php echo $org["org_id"] ?>">Upravit organizaci</a></li>
                            </ul>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
<?php endif ?>
<br>
<br>
<h4>Tvoje skladby</h4>
<div class="text-muted">Úpravu zahájíš kliknutím na název.</div>
<br>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Název</th>
            <th>Klient</th>
            <th>Producent</th>
            <th>Organizace</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($songs as $song) : ?>
            <tr>
                <td><a href="edit-song.php?sid=<?php echo $song["song_id"] ?>"><?php echo $song["song_name"] ?></a></td>
                <td><?php echo $song["client_name"] ?> <?php echo $song["client_name"] == $_SESSION["user-name"] ? "(ty)" : "" ?></td>
                <td><?php echo $song["producer_name"] ?> <?php echo $song["producer_name"] == $_SESSION["user-name"] ? "(ty)" : "" ?></td>
                <td><?php echo $song["org_name"] ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>


<?php include __DIR__ . "/inc/foot.php" ?>