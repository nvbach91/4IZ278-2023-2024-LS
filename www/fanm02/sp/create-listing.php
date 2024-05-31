
<?php
require_once 'db/Users.php';
require_once 'db/Dorms.php';


$message = null;
$error = false;

$usersDb = new UsersDB();
$dormsDb = new DormsDB();

if(!isset($_COOKIE['display_name'])){
    header('Location: login.php');
    exit;
}

$registeredUser = $usersDb->getUser($_COOKIE['display_name'], '');

if($registeredUser == null){
    setcookie('display_name', '', -1, "/");
    header('Location: login.php');
    exit;
}

$dormitories = $dormsDb->find();
$defaultDorm = $registeredUser['dorm_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    do {

        if(empty($_POST['title'])){
            $message = 'Please fill in the title';
            $error = true;
            break;
        }

        if(empty($_POST['description'])){
            $message = 'Please fill in the description';
            $error = true;
            break;
        }

        if(empty($_POST['price'])){
            $message = 'Please fill in the price';
            $error = true;
            break;
        }

        if(empty($_POST['dormitory'])){
            $message = 'Please select a dormitory';
            $error = true;
            break;
        }

        if(empty($_POST['room'])){
            $message = 'Please fill in the room';
            $error = true;
            break;
        }

        if(empty($_POST['time'])){
            $message = 'Please fill in the time';
            $error = true;
            break;
        }

        if(!empty($_FILES['image'])){
            if ($_FILES['userFile']['size'] > 5 * 1024 * 1024) {
                echo "The uploaded file is too large.";
                break;
            }
        }

        // Check if the uploaded file is set
        if (!isset($_FILES['userFile'])) {
            echo "Please select an image.";
            break;
        }

    } while(0);

    // Retrieve the form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Retrieve the uploaded file information
    $file = $_FILES['userFile'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    // Validate the form data and uploaded file
    if (empty($title) || empty($description) || empty($price) || empty($fileName)) {
        echo "Please fill in all the fields and select an image.";
    } elseif ($fileError !== 0) {
        echo "Error uploading the image. Please try again.";
    } else {
        // Move the uploaded file to a desired location
        $destination = '/path/to/your/upload/directory/' . $fileName;
        if (move_uploaded_file($fileTmpName, $destination)) {
            // Save the listing to the database (you need to implement this part)
            // ...

            // Redirect to a success page
            header("Location: success.php");
            exit;
        } else {
            echo "Error moving the uploaded image. Please try again.";
        }
    }
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Validate the form data (you can add more validation rules as needed)
    if (empty($title) || empty($description) || empty($price)) {
        echo "Please fill in all the fields.";
    } else {
        // Save the listing to the database (you need to implement this part)
        // ...

        // Redirect to a success page
        header("Location: success.php");
        exit;
    }
}
?>
<?php require __DIR__ . '/components/header.php'; ?>
<form method="post" action="create-listing.php" class="form">
    <?php if($message != null){
            echo $error == true ? '<div class="error">'.$message.'</div>' : '<div class="correct">'.$message.'</div>';
        }
    ?>
    <div class="form-container">
        <h3>Create Food-Sharing Listing</h3>
        Title*: <input type="text" minlength="3" maxlength="255" placeholder="Lemon-Dill Grilled Salmon with Garlic Mashed Potatoes" name="title"><br>
        Description*: <textarea name="description" maxlength="300" onkeyup="textCounter(this,'counter',300);" placeholder="Savor the flavors of a perfectly grilled salmon fillet, marinated in a zesty lemon-dill sauce..." form="usrform"></textarea>
        <div id="counter">300</div>
        Image: <input type='file' name='image' accept="image/png, image/jpeg"><br>
        Dormitory*:
        <select name="dormitory">
            <?php foreach($dormitories as $key=>$value): ?>
                <option value="<?= $value['id'] ?>" <?php if ($value['id'] == $defaultDorm){echo 'selected';} ?>><?= $value['name']; ?> <?php if ($value['id'] == $defaultDorm){echo '(yours)';} ?></option>
            <?php endforeach; ?>
        </select><br>
        Room*: <input type="text" minlength="3" maxlength="255" placeholder="221b" name="room"><br>
        Time*: <input type="datetime-local" name="time"><br>
        Price*: <input type="number" min="0" step="0.01" placeholder="5.99" name="price"><br>
        <input type="submit" value="Create">
        </div>
    </a>
</form>
<script>
    function textCounter(area,id,maxlimit) {
        let countfield = document.getElementById(id);
        if (area.value.length > maxlimit) {
            area.value = area.value.substring( 0, maxlimit);
            return false;
        } else {
            countfield.textContent = maxlimit - area.value.length;
        }
    }
</script>
<?php require __DIR__ . '/components/footer.php'; ?>