<?php

require __DIR__ . '/../utils/users.php';

$users = $fetchUsers();

?>

<main class="users-section">
    <h1>Users</h1>
    <ul class="user-list">
        <?php foreach ($users as $user) : ?>
            <li>
                <h2><?php echo $user['name']; ?></h2>
                <p><?php echo $user['email']; ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
</main>