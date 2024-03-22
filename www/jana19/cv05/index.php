<?php

// konfigurace pro připojení
const DB_HOSTNAME = 'localhost';
// const DB_DATABASE = 'starwars';
const DB_DATABASE = 'jana19';
const DB_USERNAME = 'jana19'; // na eso bude zde xname
const DB_PASSWORD = 'yohThietae3joochae';  // heslo do DB

// připojení do DB
$pdo = new PDO(
    'mysql:host=' . DB_HOSTNAME . ';dbname=' . DB_DATABASE, 
    DB_USERNAME,
    DB_PASSWORD
);

// nastavení SQL příkazu?
$statement = $pdo->prepare("SELECT * FROM characters WHERE 1");
// execute() spouští SQL příkaz
$statement->execute();
$characters = $statement->fetchAll(PDO::FETCH_ASSOC); // PDO:FETCH_ASSOC to předělá do čitelnější podoby - dá se nad tím iterovat for cyklem

var_dump($characters);

// CRUD - Create Read Update Delete
// uděláme třídy pro každý z nich, aby se nemusel opakovat kód

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cv05</title>
</head>
<body>
    <h1>MySQL database demo</h1>
    <!--
    <ul>
        <?php foreach($characters as $value): ?>
            <li>
                <div><?php echo $value['name']; ?></div>
                <div><?php echo $value['age']; ?> years old</div>
            </li>
        <?php endforeach; ?>
    </ul>
        -->
    
</body>
</html>