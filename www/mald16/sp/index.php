<?php session_status() === PHP_SESSION_NONE ? session_start() : null; ?>
<?php require "./logic/display-errors.php" ?>

<?php $pageName = "Dashboard" ?>


<?php include __DIR__ . "/inc/head.php"; ?>
<?php require_once __DIR__ . "/db/User.php"; ?>
<?php
require_once "./logic/allowed-users.php";
allowedUsers(["logged-in"]);

$GeneralUser = new User($_SESSION["user-email"]);

$organizations = $GeneralUser->getOrganizations();

$songs = $GeneralUser->getSongs();

$newOrders = $GeneralUser->getNewOrders();

?>


<h1>Dashboard</h1>
<hr>
<?php require __DIR__ . "/logic/messages.php"; ?>
<br>
<?php if (count($newOrders) != 0) : ?>
    <h4>Nové objednávky</h4>
    <div class="text-muted">⚠️ Nové objednávky, které čekají na producenta.</div>

    <br>
    <div style="display: flex; flex-wrap: wrap">
        <?php foreach ($newOrders as $order) : ?>
            <div class="card" style="width: 18rem; margin: 10px 10px 10px 0; border-style: dashed;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $order["name"] ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $order["client_name"] ?></h6>
                    <sup class="card-subtitle mb-2 text-muted"><?php echo $order["org_name"] ?></sup>
                    <br>
                    <div class="btn-group mt-3">
                        <a type="button" class="btn btn-primary" href="edit-song.php?sid=<?php echo $order["song_id"] ?>">Zobrazit skladbu</a>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
    <br>
    <hr>
    <br>
<?php endif ?>
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
                        <?php if ($org["role"] == 1) : ?>
                            <a type="button" class="btn btn-primary" href="order-song.php?oid=<?php echo $org["org_id"] ?>">Objednat skladbu</a>
                        <?php else : ?>
                            <a type="button" class="btn btn-primary" href="create-song.php?oid=<?php echo $org["org_id"] ?>">Nová skladba</a>
                        <?php endif ?>

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
        <?php if (count($songs) == 0) : ?>
            <tr>
                <td colspan="4" style="text-align: center;" class="text-muted">
                    Zatím nemáš žádné skladby.
                </td>
            </tr>
        <?php else : ?>
            <?php foreach ($songs as $song) : ?>
                <tr>
                    <td><a href="<?php echo $song["client_name"] == $_SESSION["user-name"] ? "view-song.php" : "edit-song.php" ?>?sid=<?php echo $song["song_id"] ?>"><?php echo $song["song_name"] ?></a></td>
                    <td><?php echo $song["client_name"] ?> <?php echo $song["client_name"] == $_SESSION["user-name"] ? "(ty)" : "" ?></td>
                    <td><?php echo $song["producer_name"] == "" ? "<i>nezvolen</i>" : $song["producer_name"] ?> <?php echo $song["producer_name"] == $_SESSION["user-name"] ? "(ty)" : "" ?></td>
                    <td><?php echo $song["org_name"] ?></td>
                </tr>
            <?php endforeach ?>
        <?php endif ?>
    </tbody>
</table>


<?php include __DIR__ . "/inc/foot.php" ?>