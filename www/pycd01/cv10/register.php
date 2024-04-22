<?php
include './classes/Users.php';
$errors = [];
$successMess = "";

const FILE_PATH = "./users.db";
const TRIM_CHARS = ' \n\r\t\v\x00';

if (!empty($_POST)) {
    $name = htmlspecialchars(trim($_POST['name'], TRIM_CHARS));
    $email = htmlspecialchars(trim($_POST['email'], TRIM_CHARS));
    $password = htmlspecialchars(trim($_POST['password'], TRIM_CHARS));
    $passwordC = htmlspecialchars(trim($_POST['passwordC'], TRIM_CHARS));

    $errors = validateUser($name, $email, $password, $passwordC);

    

    if (count($errors) == 0) {
        $successMess = "Thank you for your registration!";
        $user = new Users(0, $name, $email, password_hash($password, PASSWORD_DEFAULT), 1);
        $usersDB = new UsersDB();
        $usersDB->create($user);
        setcookie("email", $email, time() + 3600);
        setcookie("privilege", '1', time() + 3600);
        header('Location: ./main.php');
        exit();
    }
}

function validateUser($name, $email, $password, $passwordC)
{
    $errors = [];
    if (empty($name) || strlen($name) < 3 || strlen($name) > 30 || is_numeric($name) || !preg_match('/^([A-Z][a-z]+)\s([A-Z][a-z]+)((\s([A-Z][a-z]+))?)+$/', $name)) {
        array_push($errors, "Enter valid name");
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Enter valid email");
    }
    if (empty($password)  || strlen($password) < 3 || strlen($password) > 30 || is_numeric($password)) {
        array_push($errors, "Enter valid password");
    } else {
        if ($password != $passwordC) {
            array_push($errors, "Enter matching passwords");
        }
    }
    return $errors;
}
?>

<?php require __DIR__ . '/incl/header.php'; ?>
    <main>
        <h1><?php echo $successMess ?></h1>
        <form class="form-signup" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
            <?php if (isset($_POST)) : ?>
                <?php foreach ($errors as $e) : ?>
                    <div class="alert alert-danger"><?php echo $e ?></div>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="form-group">
                <label>Name:</label>
                <br>
                <input class="form-control" name="name" type="text" value="<?php echo isset($name) ? $name : '' ?>">
            </div>
            <div class="form-group">
                <label>Email:</label>
                <br>
                <input class="form-control" name="email" type="email" value="<?php echo isset($email) ? $email : '' ?>">
            </div>
            <div class="form-group">
                <label>Password:</label>
                <br>
                <input class="form-control" name="password" type="password" value="<?php echo isset($password) ? $password : '' ?>">
            </div>
            <div class="form-group">
                <label>Confirm password:</label>
                <br>
                <input class="form-control" name="passwordC" type="password" value="<?php echo isset($passwordC) ? $passwordC : '' ?>">
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
            <button class="btn btn-secondary" type="button"><a href="./">Back</a></button>
        </form>

    </main>
<?php require __DIR__ . '/incl/footer.php'; ?>
