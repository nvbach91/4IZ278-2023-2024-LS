<?php
require '../restrictions/admin_required.php';
require_once '../db/UsersDB.php';
$usersDB = new UsersDB();


//if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ban_id'])) {
//$ban_id = $_POST['ban_id'];
//$usersDB->banUser($ban_id);
//}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['back'])) {
        header('Location: admin_interface.php');
        exit;
    }

    // Uncomment the following lines if you want to implement the ban functionality
    // if (isset($_POST['ban_id'])) {
    //     $ban_id = $_POST['ban_id'];
    //     $usersDB->banUser($ban_id);
    // }
}

$users = $usersDB->fetchAllUsers();


include '../includes/admin_head.php';

?>

<h1>Manage Users</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Action</th>
    </tr>
    <?php foreach ($users as $user) : ?>
        <tr>
            <td><?php echo $user['user_id']; ?></td>
            <td><?php echo $user['email']; ?></td>
            <td>
                <form method="post">
                    <input type="hidden" name="ban_id" value="<?php echo $user['user_id']; ?>">
                    <input type="submit" value="Ban">
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<form method="post">
    <input type="submit" name="back" value="Back">
</form>
</body>

</html>