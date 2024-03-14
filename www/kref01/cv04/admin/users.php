<?php $home = "../" ?>
<?php include $home . 'includes/head.php'; ?>
<?php require $home . 'utils.php'; ?>

<?php 
$filePath = $home . "users.db";
$users = fetchUsers($filePath);
?>

<div class="headline">Registered Users</div>
<ul>
    <?php foreach($users as $user): ?>
        <li>
            <div><?php echo $user['name']; ?></div>
            <div><?php echo $user['email']; ?></div>
            <div><?php echo $user['password']; ?></div>
        </li>
    <?php endforeach; ?>
</ul>

<?php include $home . 'includes/foot.php'; ?>
