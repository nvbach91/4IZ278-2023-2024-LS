<?php 
include_once './classes/Users.php';
$errors = [];
$successMess = "";

const TRIM_CHARS = ' \n\r\t\v\x00';

if (!empty($_POST)) {
    $email = htmlspecialchars(trim($_POST['email'], TRIM_CHARS));
    $password = htmlspecialchars(trim($_POST['password'], TRIM_CHARS));

    $db = new UsersDB();
    $users = $db->readAll();
    $user = null;
    foreach ($users as $DBuser) {
        if ($DBuser['email'] == $email) {
            $user = $DBuser;
        }
    }
    
    if ($user == null) {
        array_push($errors, "User doesn't exist");
    } else {
        if (!password_verify($password, $user["password"])) {
            array_push($errors, "Incorrect password");
        }
    }

    if (count($errors) == 0) {
        $successMess = "You have logged in!";
        setcookie("email", $email, time() + 3600);
        setcookie("privilege", $user['privilege'], time() + 3600);
        header('Location: ./main.php');
        exit();
    }
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
                <label>Email:</label>
                <br>
                <input class="form-control" name="email" type="email" value="<?php echo isset($email) ? $email : '' ?>">
            </div>
            <div class="form-group">
                <label>Password:</label>
                <br>
                <input class="form-control" name="password" type="password" value="<?php echo isset($password) ? $password : '' ?>">
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
            <button class="btn btn-secondary" type="button"><a href="./">Back</a></button>
        </form>

    </main>
    <?php require __DIR__ . '/incl/footer.php'; ?>