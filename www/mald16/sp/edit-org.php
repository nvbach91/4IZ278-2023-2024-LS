<?php session_status() === PHP_SESSION_NONE ? session_start() : null; ?>

<?php require_once "./logic/allowed-users.php"; ?>
<?php require_once "./logic/email.php"; ?>
<?php require_once "./logic/validate.php"; ?>

<?php require_once "./db/Organization.php"; ?>
<?php require_once "./db/User.php"; ?>

<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

$Organization = new Organization($_GET["oid"]);
$existingOrg = $Organization->getOrganization();

if (!isset($_GET["oid"]) || empty($_GET["oid"]) || !$existingOrg) {
    $_SESSION["em"] = 5;
    header('Location: ' . "./index.php");
    exit();
}

$orgUsers = $Organization->getUsers();

$orgSongs = $Organization->getSongs();
$orgSongsEmails = array_merge(array_column($orgSongs, "client"), array_column($orgSongs, "producer"));

$orgServices = $Organization->getServices();

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
} else if (isset($_POST["user-input"]) && !empty($_POST["user-input"])) {
    $email = htmlspecialchars(trim($_POST["user-input"]));

    $User = new User($email, $Organization->orgId);
    $userExists = $User->getUser();
    $userInOrg = $User->getUserInOrg($Organization->orgId);

    $errors = [];

    if ($userInOrg) {
        array_push($errors, "Tento uživatel již dávno skládá bangery v této organizaci.");
    }

    if (!validateEmail($email)) {
        array_push($errors, "E-mailová adresa '$email' není validní.");
    }

    if (empty($errors)) {
        if (!$userExists) {
            $User->addUser($email);
        }

        if (!$userInOrg) {
            $User->addUserToOrg($email);
        }

        sendInviteEmail($email, $existingOrg["org_name"], $_SERVER['REQUEST_URI']);
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit();
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
<div style="display: flex;">
    <a href="create-song.php?oid=<?php echo $existingOrg["org_id"] ?>">Přidat novou skladbu</a>
</div>
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
        <div class="form-text">Buď obezřetný! Odstranění služby povede k odstranění této služby i u všech skladeb v této organizaci.</div>
    </div>
    <br>
    <div class="mb-3">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Jméno</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Role</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orgUsers as $orgUser) : ?>
                    <tr>
                        <th style="vertical-align: middle;"><a href="view-user.php?uid=<?php echo $orgUser['email']; ?>&oid=<?php echo $existingOrg["org_id"]; ?>"><?php echo $orgUser["name"] == null ? "<i>??</i>" : $orgUser["name"] ?> <?php echo $orgUser["name"] == $_SESSION["user-name"] ? "(ty)" : "" ?></a></th>
                        <td style="vertical-align: middle;"><?php echo $orgUser["email"] ?></td>
                        <td>
                            <div style="display: flex; align-items: center">
                                <select class="form-select" data-user-email="<?php echo $orgUser['email']; ?>" data-org-id="<?php echo $existingOrg["org_id"]; ?>" <?php echo $orgUser["role"] == 3 ? "disabled" : "" ?>>
                                    <?php if ($orgUser["role"] == 3) : ?>
                                        <option>Admin</option>
                                    <?php else : ?>
                                        <option <?php echo $orgUser["role"] == 2 ? "selected" : "" ?> value="2">Producent</option>
                                        <option <?php echo $orgUser["role"] == 1 ? "selected" : "" ?> value="1">Klient</option>
                                    <?php endif ?>
                                </select>
                                <?php if (!in_array($orgUser['org_user_id'], $orgSongsEmails) && $orgUser["role"] != 3) : ?>
                                    <a class="btn-delete" style="margin-left: 5px;" href="delete-org-user.php?uid=<?php echo $orgUser['email']; ?>&oid=<?php echo $existingOrg["org_id"]; ?>"></a>
                                <?php endif ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>

            </tbody>
        </table>
        <div class="form-text">Tlačítko pro odstranění uživatele z organizace se zobrazuje jen tehdy, když uživatel není ani producentem či klientem u žádné skladby.</div>

    </div>
    <br>
    <div class="mb-3">
        <div class="input-group">
            <input type="email" class="form-control" placeholder="ondrej@fiedler.sk" name="user-input">
            <button class="btn btn-outline-secondary" type="submit">Přidat</button>
        </div>
        <div class="form-text">Můžeš přidat i uživatele, který zatím není v systému. Automaticky se mu odešle e-mail s pozvánkou.</div>
    </div>
</form>
<script src="./scripts/edit-role.js"></script>
<?php include "./inc/foot.php" ?>