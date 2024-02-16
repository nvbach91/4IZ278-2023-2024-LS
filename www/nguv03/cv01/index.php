<?php
$greetings = "Hello world!";
$firstName = 'Elon'; // string
$lastName = 'Musk';
$age = 52; // int / double/float
$isMarried = true; // true / false
$favoriteCars = ['Ferarri', 'Mercedes', 'BMW', 'Toyota', 'Ford'];
$accounts = [
    'main' => 'Main Bank America',
    'secondary' => 'Chinese Bank',
    'secret' => 'ALJASKA secret bank',
];
$businessCardBackgroundImagUrl = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSTkbmEu88Q5On0W8qICkOTUzpkxXdbnRUj9P47UxM8bw&s';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/main.css">
</head>
<body>
    <h1><?php echo $greetings; ?></h1>
    <div class="business-card" style="background-image: url(<?php echo $businessCardBackgroundImagUrl; ?>)">
        <div class="first-name"><?php echo $firstName; ?></div>
        <div class="last-name"><?php echo $lastName; ?></div>
        <div class="age"><?php echo $age; ?></div>
    </div>
    <ul>
    <?php foreach($favoriteCars as $car): ?>
        <li><?php echo $car; ?></li>
    <?php endforeach; ?>
    </ul>
</body>
</html>