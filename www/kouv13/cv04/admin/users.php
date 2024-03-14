<?php
require('../components/utils.php');


$users = fetchUsers('../users.db');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uživatelé</title>
</head>

<body>
    <h1></h1>
    <ul>
        <?php foreach ($users as $user): ?>
            <li>
                <div class="name">
                    <?php echo $user["name"]; ?>
                </div>
                <div class="email">
                    <?php echo $user["email"]; ?>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>