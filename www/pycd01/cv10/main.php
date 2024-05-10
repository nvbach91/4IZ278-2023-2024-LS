<?php 
session_start();
include_once './classes/Users.php';
$usersDB = new UsersDB();
$users = $usersDB->readAll();
$privilege = 1;
if (!isset($_COOKIE["email"])) {
    header('Location: ./index.php');
    if ($_COOKIE["privilege"]) {
        $privilege = $_COOKIE['privilege'];
    }
}
?>
<?php require __DIR__ . '/incl/navbar.php'; ?>
<?php require __DIR__ . '/incl/header.php'; ?>
<main>
    <h1>This is the main page</h1>
    <?php if($_COOKIE['privilege'] >= 2): ?>
        <a href="./create-item.php"><button class="btn btn-primary">create</button></a>
        <?php foreach ($users as $u): ?>
            <div class="card" style="width: 22rem;">
                <p><?= $u['name'] ?></p>
                <p><?= $u['email'] ?></p>
                <a href="./edit-item.php?id=<?= $u['user_id'] ?>"><button class="btn btn-primary">edit</button></a>
                <a href="./delete-item.php?id=<?= $u['user_id'] ?>"><button class="btn btn-primary">delete</button></a>
                <?php if($_COOKIE['privilege'] >= 3): ?>
                    <a href="./user-privileges.php?id=<?= $u['user_id'] ?>"><button class="btn btn-primary">edit privileges</button></a>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</main>
<?php require __DIR__ . '/incl/footer.php'; ?>
