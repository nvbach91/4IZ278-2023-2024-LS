<?php

require __DIR__ . "/db/db.php";

require __DIR__ . "/logic/require-login.php";
require __DIR__ . "/logic/allowed-roles.php";
allowedRoles([3]);

if (isset($_GET) && !empty($_GET["uid"]) && !empty($_GET["tp"])) {
    $stmt = $pdo->prepare("SELECT * FROM cv10_users WHERE user_id = :user_id");
    $stmt->bindValue("user_id", $_GET["uid"], PDO::PARAM_INT);
    $stmt->execute();
    $userFound = $stmt->fetch();

    if ($_GET["tp"] >= 1 && $_GET["tp"] <= 3) {
        $validTp = true;
    }

    if ($userFound && $validTp) {
        $stmt = $pdo->prepare("UPDATE cv10_users SET privilege = :privilege WHERE user_id = :user_id");
        $stmt->bindValue("privilege", $_GET["tp"], PDO::PARAM_INT);
        $stmt->bindValue("user_id", $_GET["uid"], PDO::PARAM_INT);
        $stmt->execute();
        $success = $stmt->fetch();
        header('Location: ' . "user-privileges.php?eup=success");
    } else {
        header('Location: ' . "user-privileges.php?eup=error");
    }
} else {
    header('Location: ' . "user-privileges.php?eup=error");
}
