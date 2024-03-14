<?php
require("../utils/userUtils.php");

$users = fetchAllUsers("../users.db");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-Users</title>
</head>
<body>
    <main>
    <?php foreach ($users as $u): ?>
            <div>
                <h1><?php echo $u["name"] ?></h1>
                <h1><?php echo $u["email"] ?></h1>
            </div>
        <?php endforeach; ?>
    </main>
</body>
</html>
<style>
    main {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        gap: 50px;
        margin-top: 50px;
    }
    div {
        border: 5px solid black;
        border-radius: 20px;
        padding: 20px;
    }
</style>
