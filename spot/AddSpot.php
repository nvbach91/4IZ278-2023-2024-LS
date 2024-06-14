<?php
session_start();
require __DIR__ . '/../db/SpotsDB.php';
require __DIR__ . '/ImageUpload.php';
?>
<?php
$spotsDB = new SpotsDB();
$spots = $spotsDB->find();

//image specs
$target_dir = __DIR__ . "/../spot-img/";
$fileName = $_FILES['fotka']['name'];
$fileNameCmps = explode(".", $fileName);
$fileExtension = strtolower(end($fileNameCmps));
$newFileName = md5(time() . $fileName) . '.' . $fileExtension;
$target_file = $target_dir . $newFileName;
$uploadOk = 1;
$image_id = null;

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $vyhlidka = null;
    $rybnik = null;
    $ohniste = null;
    $zricenina = null;
    $pristresek = null;
    if(isset($_POST['vyhlidka'])){$vyhlidka = $_POST['vyhlidka'];};
    if(isset($_POST['rybnik'])){$rybnik = $_POST['rybnik'];};
    if(isset($_POST['ohniste'])){$ohniste = $_POST['ohniste'];};
    if(isset($_POST['zricenina'])){$zricenina = $_POST['zricenina'];};
    if(isset($_POST['pristresek'])){$pristresek = $_POST['pristresek'];};

    $categories = array($vyhlidka, $rybnik, $ohniste, $zricenina, $pristresek);
    $category = [];
    foreach ($categories as $c) {
        if (isset($c)) {
            array_push($category, $c);
        } else {
            array_push($category, null);
        }
    }
    $category = implode(',', $category);

    if ($fileName != null) {
        uploadImage($target_file);
        $image_id = $newFileName;
    }

    $user_id = $_SESSION['user_id'];
    $user_username = $_SESSION['user_username'];

    $title = trim($_POST['nazev']);
    $description = $_POST['popis'];
    $title = stripcslashes($title);
    $description = stripcslashes($description);

    $coordinatesX = $_COOKIE["longitude-for-form"];
    $coordinatesY = $_COOKIE["latitude-for-form"];
    setcookie("longitude", $coordinatesX, time() + (86400), "/");
    setcookie("latitude", $coordinatesY, time() + (86400), "/");
    $created_at = date('Y-m-d H:i:s');

    //vlozime spot do databaze
    $spotsDB->createSpot(['user_id' => $user_id, 'user_username' => $user_username, 'title' => $title, 'description' => $description, 'coordinatesX' => $coordinatesX, 'coordinatesY' => $coordinatesY, 'category' => $category, 'image_id' => $image_id, 'created_at' => $created_at]);
    
    
    /*$indexURL = '../index.php';
    echo ("<script>location.href='$indexURL'</script>");*/
    header('Location: /../index.php');
    exit();
}
?>