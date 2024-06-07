<?php

require_once 'db/Users.php';
require_once 'db/Dorms.php';

session_start();

$passwordMessage = null;
$passwordError = false;
$dormMessage = null;
$dormError = false;
$imageMessage = null;
$imageError = false;
$usersDb = new UsersDB();
$dormsDb = new DormsDB();

$dormitories = $dormsDb->find();

$password = '';
$defaultDorm = null;


if(!isset($_COOKIE['display_name'])){
    header('Location: login.php');
    session_destroy();
    exit;
}

$registeredUser = $_SESSION['user'];

if($registeredUser == null){
    setcookie('display_name', '', -1, "/");
    session_destroy();
    header('Location: login.php');
    exit;
}

$hasPassword = $registeredUser['passwordHash'] != null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'] ?? '';
    $defaultDorm = $_POST['dorm'] ?? null;

    if(password_verify(htmlspecialchars($_POST['confirmpassword'] ?? '' ), htmlspecialchars($registeredUser['passwordHash'] ?? '')) || !$hasPassword) {

        do {
            if(empty($_POST['password']) && empty($_POST['retypepassword'])){
                break;
            }

            if ($_POST['password'] !== $_POST['retypepassword']) {
                $passwordMessage = 'Passwords do not match';
                $passwordError = true;
                break;
            }

            $password = htmlspecialchars($_POST['password']);

            if (strlen($password) < 3) {
                $passwordMessage = 'Password is too short';
                $passwordError = true;
                break;
            }

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $usersDb->updatePassword($registeredUser['email'], $passwordHash);
            $passwordMessage = 'Password changed';

        } while(0);

        do {
            if(empty($_POST['dorm'])){
                break;
            }

            $defaultDorm = $_POST['dorm'];
            $dorm = $dormsDb->getDormitory(htmlspecialchars($defaultDorm));

            if($dorm == null){
                $dormMessage = 'Dormitory not found';
                $dormError = true;
                break;
            }

            $usersDb->updateDormitory($_COOKIE['display_name'], $dorm['id']);
            $dormMessage = 'Default dormitory changed';
            $defaultDorm = null;
            
        } while(0);

        do {
            if(empty($_FILES['photo']['name'])){

                if(isset($_POST['deletephoto'])){
                    if($registeredUser['photo_url'] != null && file_exists($registeredUser['photo_url'])){
                        unlink($registeredUser['photo_url']);
                        $usersDb->updatePhoto($_COOKIE['display_name'], null);
                        setcookie('photo_url', '', -1, "/");
                        $imageMessage = 'Profile picture deleted';
                    }
                }

                break;
            }

            $target_dir = "uploads/profile/";
            $target_file = $target_dir . basename($_FILES["photo"]["name"]);
            
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["photo"]["tmp_name"]);

            if($check == false) {
                $imageMessage = "File is not an image.";
                $imageError = true;
                break;
            }

            if(file_exists($target_file)) {
                $imageMessage = "File already exists.";
                $imageError = true;
                break;
            }

            if ($_FILES["photo"]["size"] > 5 * 1024 * 1024) {
                $imageMessage = "File is too large. Maximal size is 5MB.";
                $imageError = true;
                break;
            }

            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $imageMessage = "Only JPG, JPEG, PNG files are allowed.";
                $imageError = true;
                break;
            }

            if(!move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                $imageMessage = "Error uploading the file.";
                $imageError = true;
                break;
            }

            if($registeredUser['photo_url'] != null && file_exists($registeredUser['photo_url'])){
                unlink($registeredUser['photo_url']);
            }

            $usersDb->updatePhoto($_COOKIE['display_name'], $target_file);
            $imageMessage = 'Profile picture changed';
            setcookie('photo_url', $target_file, time() + 3600, "/");

        } while(0);

    }
    else {
        $passwordMessage = 'Wrong current password';
        $passwordError = true;
    }

}
?>
<?php include __DIR__ . '/components/header.php' ?>
<form method="post" action="settings.php" class="form" enctype="multipart/form-data">
    <?php if($passwordMessage != null){
            echo $passwordError == true ? '<div class="error">'.$passwordMessage.'</div>' : '<div class="correct">'.$passwordMessage.'</div>';
        }
    ?>
    <?php if($imageMessage != null){
            echo $imageError == true ? '<div class="error">'.$imageMessage.'</div>' : '<div class="correct">'.$imageMessage.'</div>';
        }
    ?>
    <?php if($dormMessage != null){
            echo $dormError == true ? '<div class="error">'.$dormMessage.'</div>' : '<div class="correct">'.$dormMessage.'</div>';
        }
    ?>
<div class="form-container">
    <div class="form-group">
        <label for="photo">Choose profile picture:</label>
        <input class="form-control-file" type="file" name="photo" id="photo" accept="image/png, image/jpeg">
    </div>
    <div class="form-group form-check">
        <input class="form-check-input" type="checkbox" name="deletephoto" id="deletephoto">
        <label class="form-check-label" for="deletephoto">Delete current picture</label>
    </div>
    <div class="form-group">
        <label for="dorm">Default dormitory:</label>
        <select class="form-control" name="dorm" id="dorm">
            <option value=""></option>
            <?php foreach($dormitories as $key=>$value): ?>
                <option <?php if($defaultDorm == $value['id']) echo 'selected'; ?> value="<?= $value['id'] ?>"><?= $value['name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="password">Change password:</label>
        <input class="form-control" value="<?php echo $password; ?>" type="password" name="password" id="password">
    </div>
    <div class="form-group">
        <label for="retypepassword">Retype new password:</label>
        <input class="form-control" type="password" name="retypepassword" id="retypepassword">
    </div>
    <?php if($hasPassword): ?>
        <div class="form-group">
            <label for="confirmpassword">Confirm with current password:</label>
            <input class="form-control" type="password" name="confirmpassword" id="confirmpassword">
        </div>
    <?php endif; ?>
    <input class="btn btn-primary" type="submit" value="Save">
</div>
</form>

<?php include __DIR__ . '/components/footer.php' ?>