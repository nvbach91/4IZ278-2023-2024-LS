<?php
require __DIR__ . '/../utils/utils.php';
$filename = __DIR__ . '/../database/users.db';

$users = fetchUsers($filename);
?>

<?php include '../includes/head.php'; ?>
<div class="container mt-5">
    <h1 class="text-center mb-4">User List</h1>

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $email => $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user['name']); ?></td>
                <td><?php echo htmlspecialchars($email); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include '../includes/foot.php'; ?>

