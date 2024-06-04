<?php
require_once 'db/Users.php';
require_once 'db/Dorms.php';
require_once 'db/Meals.php';

$message = null;
$error = false;

$usersDb = new UsersDB();
$dormsDb = new DormsDB();
$mealsDb = new MealsDB();

if (!isset($_COOKIE['display_name'])) {
    header('Location: login.php');
    exit;
}

$registeredUser = $usersDb->getUser(htmlspecialchars($_COOKIE['display_name']), '');

if ($registeredUser == null) {
    setcookie('display_name', '', -1, "/");
    header('Location: login.php');
    exit;
}

$dormitories = $dormsDb->find();
$defaultDorm = $registeredUser['dorm_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    do {

        if (empty($_POST['title'])) {
            $message = 'Please fill in the title';
            $error = true;
            break;
        }

        if (empty($_POST['description'])) {
            $message = 'Please fill in the description';
            $error = true;
            break;
        }

        if (empty($_POST['price'])) {
            $message = 'Please fill in the price';
            $error = true;
            break;
        }

        if (empty($_POST['dormitory'])) {
            $message = 'Please select a dormitory';
            $error = true;
            break;
        }

        if (empty($_POST['room'])) {
            $message = 'Please fill in the room';
            $error = true;
            break;
        }

        if (empty($_POST['time'])) {
            $message = 'Please fill in the time';
            $error = true;
            break;
        }

        $title = htmlspecialchars($_POST['title']);
        $description = htmlspecialchars($_POST['description']);
        $price = htmlspecialchars($_POST['price']);

        $targetFile = null;

        if (!empty($_FILES['picture']['name'])) {
            $targetDir = "uploads/listing/";
            $targetFile = $targetDir . basename($_FILES["picture"]["name"]);

            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["picture"]["tmp_name"]);

            if ($check == false) {
                $message = "File is not an image.";
                $error = true;
                break;
            }

            if (file_exists($targetFile)) {
                $message = "File already exists.";
                $error = true;
                break;
            }

            if ($_FILES["picture"]["size"] > 5 * 1024 * 1024) {
                $message = "File is too large. Maximal size is 5MB.";
                $error = true;
                break;
            }

            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $message = "Only JPG, JPEG, PNG files are allowed.";
                $error = true;
                break;
            }

            if (!move_uploaded_file($_FILES["picture"]["tmp_name"], $targetFile)) {
                $message = "Error uploading the file.";
                $error = true;
                break;
            }   
        }

        $mealsDb->create([$registeredUser['id'], $title, $description, $targetFile, $_POST['dormitory'], $_POST['room'], $_POST['time'], $price]);
        $message = 'Listing successfuly created';
    } while (0);
}

?>
<?php require __DIR__ . '/components/header.php'; ?>
<form method="post" action="create-listing.php" class="form" id="myform" enctype="multipart/form-data">
    <?php if ($message != null) {
        echo $error == true ? '<div class="error">' . $message . '</div>' : '<div class="correct">' . $message . '</div>';
    }
    ?>
    <div class="form-container">

        <div class="form-group">
            <h3>Create Food-Sharing Listing</h3>
            <label for="title">Title*:</label>
            <input type="text" class="form-control" minlength="3" maxlength="255" placeholder="Lemon-Dill Grilled Salmon with Garlic Mashed Potatoes" name="title">
        </div>
        <div class="form-group">
            <label for="description">Description*:</label>
            <textarea class="form-control" name="description" form="myform" maxlength="300" onkeyup="textCounter(this,'counter',300);" placeholder="Savor the flavors of a perfectly grilled salmon fillet, marinated in a zesty lemon-dill sauce..." form="usrform"></textarea>
            <div id="counter">300</div>
        </div>
        <div class="form-group">
            <label for="picture">Image:</label>
            <input type='file' class="form-control-file" name='picture' id="picture" accept="image/png, image/jpeg">
        </div>
        <div class="form-group">
            <label for="dormitory">Dormitory*:</label>
            <select class="form-control" name="dormitory">
                <?php foreach ($dormitories as $key => $value) : ?>
                    <option value="<?= $value['id'] ?>" <?php if ($value['id'] == $defaultDorm) {
                                                            echo 'selected';
                                                        } ?>><?= $value['name']; ?> <?php if ($value['id'] == $defaultDorm) {
                                                                                                                                                echo '(yours)';
                                                                                                                                            } ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="room">Room*:</label>
            <input type="text" class="form-control" minlength="3" maxlength="255" placeholder="221b" name="room">
        </div>
        <div class="form-group">
            <label for="time">Time*:</label>
            <input type="datetime-local" class="form-control" name="time">
        </div>
        <div class="form-group">
            <label for="price">Price*:</label>
            <input type="number" class="form-control" min="0" step="0.01" placeholder="5.99" name="price">
        </div>
        <input type="submit" class="btn btn-primary" value="Create">
        <!--
        <h3>Create Food-Sharing Listing</h3>
        Title*: <input type="text" minlength="3" maxlength="255" placeholder="Lemon-Dill Grilled Salmon with Garlic Mashed Potatoes" name="title"><br>
        Description*: <textarea name="description" form="myform" maxlength="300" onkeyup="textCounter(this,'counter',300);" placeholder="Savor the flavors of a perfectly grilled salmon fillet, marinated in a zesty lemon-dill sauce..." form="usrform"></textarea>
        <div id="counter">300</div>
        Image: <input type='file' name='picture' id="picture" accept="image/png, image/jpeg"><br>
        Dormitory*:
        <select name="dormitory">
            <?php foreach ($dormitories as $key => $value) : ?>
                <option value="<?= $value['id'] ?>" <?php if ($value['id'] == $defaultDorm) {
                                                        echo 'selected';
                                                    } ?>><?= $value['name']; ?> <?php if ($value['id'] == $defaultDorm) {
                                                                                                                                            echo '(yours)';
                                                                                                                                        } ?></option>
            <?php endforeach; ?>
        </select><br>
        Room*: <input type="text" minlength="3" maxlength="255" placeholder="221b" name="room"><br>
        Time*: <input type="datetime-local" name="time"><br>
        Price*: <input type="number" min="0" step="0.01" placeholder="5.99" name="price"><br>
        <input type="submit" value="Create">-->
    </div>
    </a>
</form>
<script>
    function textCounter(area, id, maxlimit) {
        let countfield = document.getElementById(id);
        if (area.value.length > maxlimit) {
            area.value = area.value.substring(0, maxlimit);
            return false;
        } else {
            countfield.textContent = maxlimit - area.value.length;
        }
    }
</script>
<?php require __DIR__ . '/components/footer.php'; ?>