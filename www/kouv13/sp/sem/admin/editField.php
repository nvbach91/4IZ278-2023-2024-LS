<?php
if (isset($_POST["submit"])) {
    require_once __DIR__ . '../../config.php';
    include BASE_PATH . '/includes/authAdmin.php';
    require_once BASE_PATH . '/includes/incl.php';

    $name = htmlspecialchars($_POST["name"]);
    $desc = htmlspecialchars($_POST["description"]);
    $capacity = htmlspecialchars($_POST["capacity"]);
    $price = htmlspecialchars($_POST["price"]);
    $idField = htmlspecialchars($_POST["id"]);

    if ($field->editField($name, $desc, $capacity, $price, $idField)) {
        header("Location: field.php?idfield=$idField&edit=1");
        exit();
    } else {
        header("Location: field.php?idfield=$idField&edit=2");
        exit();
    }
}
