<?php
// pripojeni do db
require 'db.php';

// pristup jen pro admina
require 'admin_required.php';

$stmt = $db->prepare('DELETE FROM cv11_products WHERE product_id=?');
$stmt->execute([$_GET['product_id']]);

header('Location: index.php');

?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8" />
    <title>PHP Shopping App</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>

</body>

</html>
