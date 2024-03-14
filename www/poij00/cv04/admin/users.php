<?php 
require '../utils/functions.php';

$lines = lines('../users.db');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <h1>All users</h1>
        <div class="form-errors">
            <?php foreach($lines as $line): ?>
                <p><?php echo $line ?></p>
            <?php endforeach; ?>
        </div>
</body>
</html>