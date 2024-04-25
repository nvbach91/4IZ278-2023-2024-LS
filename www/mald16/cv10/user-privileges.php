<?php require __DIR__ . "/inc/head.php"; ?>
<?php

// require __DIR__ . "/logic/display-errors.php";
require __DIR__ . "/logic/require-login.php";
require __DIR__ . "/logic/allowed-roles.php";
allowedRoles([3]);

require __DIR__ . "/db/db.php";

$stmt = $pdo->prepare("SELECT * FROM cv10_users");
$stmt->execute();
$users = $stmt->fetchAll();


?>
<div class="container" style="width: 60%; margin: 0 auto; margin-top: 100px">
    <?php if ($_GET["eup"] == "success") : ?>
        <div class="alert alert-success" role="alert">
            Role uživatele byla úspěšně změněna!
        </div>
    <?php endif ?>
    <?php if ($_GET["eup"] == "error") : ?>
        <div class="alert alert-danger" role="alert">
            Nastala chyba při změně role uživatele.
        </div>
    <?php endif ?>
    <h1>Uživatelé</h1>
    <br>
    <br>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">E-mail</th>
                <th scope="col">Role</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td style="vertical-align: middle;"><?php echo $user["email"] ?></td>
                    <td>
                        <select class="form-select" onchange="setUserPrivilege(this, <?php echo $user['user_id']; ?>)">
                            <option value="1" <?php echo $user["privilege"] == 1 ? "selected" : ""; ?>>Uživatel</option>
                            <option value="2" <?php echo $user["privilege"] == 2 ? "selected" : ""; ?>>Manažer</option>
                            <option value="3" <?php echo $user["privilege"] == 3 ? "selected" : ""; ?>>Administrátor</option>
                        </select>
                    </td>

                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<script>
    function setUserPrivilege(selectElement, userId) {
        var targetPrivilege = selectElement.value;
        window.location.href = "edit-user-privilege.php?uid=" + userId + "&tp=" + targetPrivilege;
    }
</script>
<?php require __DIR__ . "/inc/foot.php"; ?>