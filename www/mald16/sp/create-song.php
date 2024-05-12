<?php session_status() === PHP_SESSION_NONE ? session_start() : null; ?>

<?php require_once "./logic/allowed-users.php"; ?>
<?php require_once "./logic/validate.php"; ?>
<?php require_once "./db/Organization.php"; ?>
<?php require_once "./db/Song.php"; ?>
<?php require_once "./db/User.php"; ?>

<?php

$Organization = new Organization($_GET["oid"]);
$User = new User($_SESSION["user-email"], $_GET["oid"]);

$existingOrganization = $Organization->getOrganization();

if (!isset($_GET["oid"]) || empty($_GET["oid"]) || !$existingOrganization) {
    $_SESSION["em"] = 5;
    header('Location: ' . "./index.php");
    exit();
}

$orgServices = $Organization->getServices();

$clients = $Organization->getUsers(1);
$clientEmails = array_column($clients, 'email');

$producers = $Organization->getUsers(2);

if (isset($_POST) && !empty($_POST)) {
    $name = htmlspecialchars(trim($_POST["song-name"]));
    $producer = htmlspecialchars(trim($_POST["producer"]));

    if (($_POST["client"]) == "null") {
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
        Song::createSong($name, $producer, $client, $services, $existingOrganization["org_id"]);
    }
}
?>

<?php include "./inc/head.php" ?>
<h1>Přidání nové skladby</h1>
<h6 class="text-muted"><?php echo $existingOrganization["org_name"] ?></h6>
<hr>
<?php require __DIR__ . "/logic/errors.php" ?>
<?php require "./logic/messages.php"; ?>
<form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
    <div class="mb-3">
        <label class="form-label">Název skladby <span class="form-required">*</span></label>
        <input type="text" name="song-name" class="form-control" placeholder="Beat it" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Producent <span class="form-required">*</span></label>
        <select class="form-select" name="producer" <?php echo count($producers) == 0 ? "disabled" : "" ?>>
            <?php foreach ($producers as $prod) : ?>
                <option value="<?php echo $prod["org_user_id"] ?>"><?php echo $prod["name"] == "" ? $prod["email"] : $prod["name"] ?></option>
            <?php endforeach ?>
        </select>
        <?php if (count($producers) == 0) : ?>
            <p class="text-muted form-text">Tato organizace nemá žádné producenty. Přidej alespoň jednoho <a href="edit-org.php?oid=<?php echo $existingOrganization["org_id"] ?>">zde</a>.</p>
        <?php endif ?>
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
                <option value="null" selected>nevybrán</option>
                <?php foreach ($clients as $cli) : ?>
                    <option value="<?php echo $cli["org_user_id"] ?>">
                        <?php echo $cli["name"] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        <?php endif; ?>
    </div>


    <button type="submit" class="btn btn-primary" <?php echo (count($orgServices) == 0 || count($producers) == 0) ? "disabled" : "" ?>>Přidat skladbu</button>
</form>
<?php include "./inc/foot.php" ?>