<?php require __DIR__ . '/../includes/header.php'; ?>
<?php
require_once __DIR__ . '/../db/UserDatabase.php';

$usersDB = new UsersDatabase();
$users = $usersDB->readAllUsers();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['deleteUser'])) {
        // Handle delete product type
        $userId = $_POST['userId'];
        $result = $usersDB->deleteUser($userId);

        if ($result) {
            echo "User deleted successfully!";
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit();
        } else {
            echo "Error: Could not delete user.";
        }
    }
}

?>
<main class="container">
    <h1 class="my-4">Users</h1>
    <div>
        <div class="list-group">
            <?php foreach ($users as $user) : ?>
                <div class="list-group-item">
                    <form method="POST" action="">
                        <span>ID <?= number_format($user['idUser'], 0); ?>: <?= htmlspecialchars($user['email']); ?></span>
                        <span>Password: <?= htmlspecialchars($user['password']); ?>, Auth type: <?= htmlspecialchars($user['authType']); ?></span>
                        <span>Role: <?= number_format($user['role'], 0); ?></span>

                        <button class="btn btn-danger float-right" type="submit" name="deleteUser">Delete</button>
                        <input type="hidden" name="userId" value="<?= $user['idUser']; ?>">
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>