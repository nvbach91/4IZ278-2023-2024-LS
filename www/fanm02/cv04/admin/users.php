<?php

require __DIR__ . '/../utils/utils.php';
define('TITLE', 'Users');

$users = fetchUsers();
?>

<?php include '../components/header.php'; ?>
<link rel="stylesheet" href="../styles/style.css">
<div class="center">
    <h1>Users</h1>
</div>
<main>
    <div class="center">
        <ul class="users">
            <?php foreach ($users as $userEmail => $userData): ?>
            <li class="user">
                <div class="user-name"><?php echo $userData['name']; ?></div>
                <div class="user-email"><?php echo $userEmail; ?></div>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</main>
<?php include '../components/footer.php'; ?>