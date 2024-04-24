<?php

include 'includes/head.php';
require 'classes/GoodsDB.php';
require 'admin-required.php';

$usersDB = new UsersDB();

if (!empty($_POST)) {
    $privilege = $_POST['privilege'];
    $email = $_POST['email'];
    if ($privilege < 3 && $privilege >= 0){
        $usersDB->updateUser($email, $privilege);
    } else {
        echo 'Privileges can only be: [0, 1, 2]';
    }
}

$users = $usersDB->find();

?>

<div class="container container-products-margin">
    <h2 class="container-ref-page">Change user privileges:</h2>
    <ul>
        <?php foreach ($users as $user) : ?>
            <li>
                <div>
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input name="email" readonly value="<?php echo $user['email']; ?>">
                        <label>New privilege (currently <?php echo $user['privilege']; ?>):&nbsp;</label><input name="privilege">
                        <button type="submit">Edit</button>
                    </form>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php include 'includes/footer.php'; ?>