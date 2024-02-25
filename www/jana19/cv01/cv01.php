<?php
$greetings = "Hello world!";
$name = 'Karel'; // string
// $lastName = 'Vomáčka';
$age = 40; // inte, double, float
$isMarried = true; // boolean
$favouriteCars = ['Ferarri', 'Marcedes', 'BMW', 'Toyota']; // pole - pro vypsání je potřeba projít cyklem
$accounts = [ // asociativní pole - obdoba objektu JS
    'main' => 'Banka Creditas',
    'secondary' => 'Chinese Bank',
    'secret' => 'Podnikatelská družstevní záložna',
];
$backgroundImage = 'URL';?>

<body>
    <h1><?php echo $greetings; ?></h1>
    <div class="business-card" style="background-image: url(<?php echo $backgroundImage ?>)">
        <div class='first-name'><?php echo $firstName; ?></div>
        <div class='last-name'><?php echo $lastName; ?></div>
        <div class='age'><?php echo $age; ?></div>
        <!-- 
        <div class='status'><?php echo $isMarried; ?></div>
        <div class='car'><?php echo $favouriteCars; ?></div>
        <div class='account'><?php echo $accounts; ?></div>
        -->
    </div>
    <ul>
        <?php foreach ($favouriteCars as $car) : ?>
            <li><?php echo $car; ?></li>
        <?php endforeach; ?>
    </ul>
