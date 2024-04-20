<?php
require 'admin_required.php';
require './db/UserDB.php';


$userDB = new UserDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $privilege = $_POST['privilege'];

    $result = $userDB->setPrivilege($email, $privilege);

    if ($result) {
        $message = "Privilege updated successfully";
    } else {
        $message = "Failed to update privilege";
    }
}

$users = $userDB->fetchAllUsers();
?>

<h1>User Privileges</h1>
<?php if (isset($message)): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>

<table>
    <tr>
        <th>Email</th>
        <th>Privilege</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user['email']; ?></td>
            <td><?php echo $user['privilege']; ?></td>
            <td>
                <form method="POST">
                    <input type="hidden" name="email" value="<?php echo $user['email']; ?>">
                    <select name="privilege">
                        <option value="0">Select Privilege</option>
                        <option value="1">User</option>
                        <option value="2">Manager</option>
                        <option value="3">Administrator</option>
                    </select>
                    <button type="submit">Set Privilege</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>