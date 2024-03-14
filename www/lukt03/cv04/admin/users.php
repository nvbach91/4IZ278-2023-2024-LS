<?php

require __DIR__ . '/../utils/utils.php';
define('TITLE', 'Users');

$users = fetchUsers();
?>

<?php include '../includes/head.php'; ?>
<h1>Users</h1>
<main>
    <ul class="users">
        <?php foreach ($users as $userEmail => $userData): ?>
        <li class="user">
            <div class="user-name"><?php echo $userData['name']; ?></div>
            <div class="user-email"><?php echo $userEmail; ?></div>
        </li>
        <?php endforeach; ?>
    </ul>
</main>
<?php include '../includes/foot.php'; ?>
