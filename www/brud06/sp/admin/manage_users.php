<?php
session_start();
require '../restrictions/admin_required.php';
require_once '../db/UsersDB.php';
require_once '../db/CharactersDB.php';
$usersDB = new UsersDB();
$charactersDB = new CharactersDB();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['back'])) {
        header('Location: admin_interface.php');
        exit;
    }

    if (isset($_POST['user_id'])) {
        $user_id = $_POST['user_id'];
        if (isset($_POST['ban'])) {
            $usersDB->banUser($user_id);
        } elseif (isset($_POST['unban'])) {
            $usersDB->unbanUser($user_id);
        }
    }
}


$users = $usersDB->fetchRegularUsers();


include '../includes/admin_head.php';

?>

<h1>Manage Users</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Character Name</th>
        <th>Character Level</th>
        <th>Character Gold</th>
        <th>Action</th>
    </tr>
    <?php foreach ($users as $user) : ?>
    <?php $character = $charactersDB->findCharacterByUserId($user['user_id']); ?>
    <tr>
        <td><?php echo $user['user_id']; ?></td>
        <td><?php echo $user['email']; ?></td>
        <td><?php echo $character ? $character['name'] : 'No character'; ?></td>
        <td><?php echo $character ? $character['level'] : 'N/A'; ?></td>
        <td><?php echo $character ? $character['gold'] : 'N/A'; ?></td>
        <td>
            <form method="post">
                <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                <?php if ($user['isBanned']) : ?>
                    <input type="submit" name="unban" value="unban">
                <?php else : ?>
                    <input type="submit" name="ban" value="ban">
                <?php endif; ?>
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