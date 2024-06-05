
<?php 
require_once '../restrictions/admin_required.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['createItem'])) {
        header('Location: create_item.php');
        exit;
    } elseif (isset($_POST['editItem'])) {
        header('Location: edit-item.php');
        exit;
    } elseif (isset($_POST['manageUsers'])) {
        header('Location: manage_users.php');
        exit;
    }
}
if (isset($_SESSION['success_message'])) {
    echo $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}
?>
<?php include '../includes/admin_head.php'; ?>
<form method="POST">
    <button type="submit" name="createItem">Create Item</button>
    <button type="submit" name="manageUsers">Manage Users</button>
</form>
<?php include '../includes/foot.php'; ?>