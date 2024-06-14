<?php

require_once '../Controller/entryPrivilege.php';
require '../Controller/editUserPrivilege.php';

?>

<?php include './includes/head.php'; ?>
<body>
    <?php require './includes/navbar.php'; ?>
    <div class="user-container">
    <?php foreach ($users as $user): ?>
        <div class="user">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="user-form">
                <div class="user-form-group">
                    <label for="user_id">User ID</label>
                    <input type="number" class="form-control" name="user_id" value="<?php echo $user['user_id']; ?>" readonly>
                    <label for="name">Name</label>
                    <input type="name" class="form-control" name="name" value="<?php echo $user['name']; ?>" readonly>
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" value="<?php echo $user['email']; ?>" readonly>
                    <label for="privilege">Privilege</label>
                    <input type="number" class="form-control" name="privilege" value="<?php echo $user['privilege']; ?>" max="1">
                </div>
                <button type="submit" class="edit-button">Save changes</button>
            </form>
        </div>
    <?php endforeach; ?>
    </div>
    <?php include './includes/footer.php'; ?>
</body>
</html>