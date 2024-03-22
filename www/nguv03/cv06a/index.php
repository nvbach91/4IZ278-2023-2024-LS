<?php
// pdo database connection example

const DB_HOSTNAME = 'localhost';
const DB_DATABASE = 'starwars';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';

$pdo = new PDO(
    'mysql:host=' . DB_HOSTNAME . ';dbname=' . DB_DATABASE,
    DB_USERNAME,
    DB_PASSWORD
);

$statement = $pdo->prepare("SELECT * FROM characters WHERE 1");
$statement->execute();
$characters = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>MySQL database demo</h1>
    <ul>
        <?php foreach($characters as $value): ?>
            <li>
                <div><?php echo $value['name']; ?></div>
                <div><?php echo $value['age']; ?> years old</div>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>