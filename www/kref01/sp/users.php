<?php include './includes/head.php'; ?>

<?php
require_once './classes/UsersDB.php';

$usersDB = new UsersDB();

if ($role !== 'admin') {
    echo "<div class='container'><div class='error-banner'>You do not have permission to access this site.</div></div>";
    include './includes/foot.php';
    exit;
}

$users = $usersDB->getAllUsers();
?>

<?php if ($role === 'admin'): ?>
    <div class="container">
        <div class="admin-dashboard">
            <h1>All Users</h1>
                <table>
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($user['user_id']); ?></td>
                                <td><?php echo htmlspecialchars($user['first_name']); ?></td>
                                <td><?php echo htmlspecialchars($user['last_name']); ?></td>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                <td><?php echo htmlspecialchars($user['role']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
        </div>
    </div>
<?php endif; ?>

<?php include './includes/foot.php'; ?>
