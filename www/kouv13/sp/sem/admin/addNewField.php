<?php
if (isset($_POST["submit"])) {
    require_once __DIR__ . '../../config.php';
    include BASE_PATH . '/includes/authAdmin.php';
    require_once BASE_PATH . '/db/db.class.php';
    $db = new db();

    $name = htmlspecialchars($_POST["name"]);
    $desc = htmlspecialchars($_POST["description"]);
    $capacity = htmlspecialchars($_POST["capacity"]);
    $price = htmlspecialchars($_POST["price"]);


    $imgName = $_FILES['image']['name'];
    $img_tmp = $_FILES['image']['tmp_name'];
    $upload_dir = '../imgs/';

    move_uploaded_file($img_tmp, $upload_dir . $imgName);


    $idField = $db->addField($name, $desc, $capacity, $price, $imgName);
    if (!empty($idField)) {
        header("Location: field.php?idfield=$idField&addf=1");
        exit();
    } else {
        header("Location: ?addf=2");
        exit();
    }
}
