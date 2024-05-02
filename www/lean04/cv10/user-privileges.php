<?php require __DIR__ . '/auth/adminRequired.php'; ?>
<?php

$usersDB = new UsersDB();
$users = $usersDB->findAll();

?>

<main class="users-section">
    <h1>Users</h1>
    <ul class="user-list">
        <?php foreach ($users as $user) : ?>
            <li>
                <h2><?php echo $user['name']; ?></h2>
                <p><?php echo $user['email']; ?></p>
                <form action="./users/set_privileges.php" method="post">
                    <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                    <select name="privilege">
                        <option value="0" <?php echo $user['privilege'] === 0 ? 'selected' : ''; ?>>Regular User</option>
                        <option value="1" <?php echo $user['privilege'] === 1 ? 'selected' : ''; ?>>Manager</option>
                        <option value="2" <?php echo $user['privilege'] === 2 ? 'selected' : ''; ?>>Administrator</option>
                    </select>
                    <input type="submit" value="Set Privilege">
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</main>