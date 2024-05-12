<?php
session_start();
require 'db.php';
require 'image-upload.php';
?>
<?php
//image specs
$target_dir = "spot-img/";
$fileName = $_FILES['fotka']['name'];
$fileNameCmps = explode(".", $fileName);
$fileExtension = strtolower(end($fileNameCmps));
$newFileName = md5(time() . $fileName) . '.' . $fileExtension;
$target_file = $target_dir . $newFileName;
$uploadOk = 1;


if ('POST' == $_SERVER['REQUEST_METHOD']) {

    $categories = array($_POST['vyhlidka'], $_POST['rybnik'], $_POST['ohniste'], $_POST['zricenina'], $_POST['pristresek']);
    $category = [];
    foreach ($categories as $c) {
        if (isset($c)) {
            array_push($category, $c);
        }
        else{
            array_push($category, null);
        }
    }

    uploadImage($target_file);
    $user_id = $_SESSION['user_id'];
    $user_username = $_SESSION['user_username'];
    $title = trim($_POST['nazev']);
    $description = $_POST['popis'];
    $coordinatesX = $_COOKIE["longitude-for-form"];
    $coordinatesY = $_COOKIE["latitude-for-form"];
    setcookie("longitude", $coordinatesX, time() + (86400), "/");
    setcookie("latitude", $coordinatesY, time() + (86400), "/");
    $image_id = $newFileName;
    $created_at = date('Y-m-d H:i:s');

    //vlozime usera do databaze
    $stmt = $db->prepare('INSERT INTO spots(user_id, username, title, description, coordinatesX, coordinatesY, category, image_id, created_at) VALUES (:user_id, :username, :title, :description, :coordinatesX, :coordinatesY, :category, :image_id, :created_at)');
    $stmt->execute([
        'user_id' => $user_id,
        'username'=> $user_username,
        'title' => $title,
        'description' => $description,
        'coordinatesX' => $coordinatesX,
        'coordinatesY' => $coordinatesY,
        'category' => implode(',', $category),
        'image_id' => $image_id,
        'created_at' => $created_at
    ]);
}

header('Location: index.php');
?>