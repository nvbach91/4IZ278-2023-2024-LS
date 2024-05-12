<?php session_status() === PHP_SESSION_NONE ? session_start() : null; ?>

<?php require_once "./logic/allowed-users.php"; ?>
<?php require_once "./logic/validate.php"; ?>

<?php require_once "./db/Song.php"; ?>
<?php require_once "./db/Organization.php"; ?>
<?php require_once "./db/User.php"; ?>

<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$Song = new Song($_GET["sid"]);

$Organization = new Organization($Song->orgId);

$User = new User($_SESSION["user-email"], $Organization->orgId);


if (!isset($_GET["sid"]) || empty($_GET["sid"]) || !$Song || !$Organization) {
    $_SESSION["em"] = 3;
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

    if ($_POST["client"] == "null") {
        if (in_array($_SESSION["user-email"], $clientEmails)) {
            $client = $User->getUserInOrg()["org_user_id"];
        } else {
            $client = null;
        }
    } else {
        $client = htmlspecialchars(trim($_POST["client"]));
    }

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
        Song::editSong($name, $producer, $client, $services, $_GET["sid"]);
    }
}
?>

<?php include "./inc/head.php" ?>
<h1>Úprava skladby</h1>
<h6 class="text-muted"><?php echo $Organization->orgName ?></h6>
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
                <option value="<?php echo $producer["org_user_id"] ?>" <?php echo $producer["org_user_id"] == $Song->producer ? "selected" : "" ?>><?php echo $producer["name"] ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Služby <span class="form-required">*</span></label>
        <br>
        <?php foreach ($orgServices as $orgServ) :
            $selected = in_array($orgServ["service_id"], $songServiceIds);
        ?>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="services[]" value="<?php echo $orgServ["service_id"] ?>" <?php echo $selected ? "checked" : "" ?>>
                <label class="form-check-label"><?php echo $orgServ["service_name"] ?></label>
            </div>
        <?php endforeach ?>
    </div>
    <div class="mb-3">
        <label class="form-label">Klient</label>
        <?php if (in_array($_SESSION["user-email"], $clientEmails)) : ?>
            <select class="form-select" name="client" disabled>
                <option selected>
                    <?php echo $_SESSION["user-name"] ?> (ty)
                </option>
            </select>
        <?php else : ?>
            <select class="form-select" name="client">
                <option value="null" <?php echo empty($Song->client) ? "selected" : "" ?>>nevybrán</option>
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
<?php include "./inc/foot.php" ?>