<?php session_status() === PHP_SESSION_NONE ? session_start() : null; ?>
<?php require "./logic/display-errors.php" ?>

<?php $pageName = "Zobrazení uživatele" ?>


<?php
require_once "./logic/allowed-users.php";
allowedUsers(["logged-in"]);
?>
<?php require_once "./logic/validate.php"; ?>

<?php require_once "./db/Organization.php"; ?>
<?php require_once "./db/User.php"; ?>

<?php
$User = new User($_GET["uid"]);
$AccessUser = new User($_SESSION["user-email"], $_GET["oid"]); // an user, who is trying to make this change
if ($AccessUser->getUserInOrg() == false) {
    $_SESSION["em"] = 25;
    header('Location: ' . "./index.php");
    exit();
}

$existingUser = $User->getUser();

$userSongs = $User->getSongs();


if (!isset($_GET["uid"]) || empty($_GET["uid"]) || !isset($_GET["oid"]) || empty($_GET["oid"]) || !$existingUser) {
    $_SESSION["em"] = 17;
    header('Location: ' . "./index.php");
    exit();
} else if ($AccessUser->getRole() == 1) {
    $_SESSION["em"] = 25;
    header('Location: ' . "./index.php");
    exit();
}
?>

<?php include "./inc/head.php" ?>
<h1>Zobrazení uživatele</h1>
<h6 class="text-muted"><?php echo $existingUser["name"] ?></h6>
<hr>
<?php require __DIR__ . "/logic/errors.php" ?>
<?php require "./logic/messages.php"; ?>

<table class="table">
    <thead>
        <tr>
            <th scope="col">Název skladby</th>
            <th scope="col">Role</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($userSongs as $userSong) : ?>
            <tr>
                <td><a href="edit-song.php?sid=<?php echo $userSong['song_id']; ?>"><?php echo $userSong["song_name"] ?></a></td>
                <td>
                    <?php echo $existingUser["name"] == $userSong["producer_name"] ? "producent" : "klient" ?>
                </td>
            </tr>
        <?php endforeach ?>

    </tbody>
</table>
<script src="./scripts/edit-role.js"></script>
<?php include "./inc/foot.php" ?>