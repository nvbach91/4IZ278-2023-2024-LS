<?php
$greetins = 'My business card in PHP';
$firstName = 'Daniel';
$lastname = 'Brus';
$age = 22;
$isMarried = false;
$favoriteCars = ['BMW', 'Audi', 'Mercedes', 'Skoda'];
$accounts = [
    'main' => 'Main Bank America',
    'secondary' => 'Chinese Bank',
    'secret' => 'ALASKA BANK'
];
$profession = 'Student';
$street = 'Nam W Churchilla 4';
$city = 'Praha';
$phoneNumber = '+420 702 421 721';
$email = 'brud06@vse.cz';
$website = 'eso.vse.cz/~brud06/sp1/';
$isLookingForJob = true;
$companyName = 'Vysoka Skola Ekonomicka v Praze';
$postNumber = "143 00";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>

</head>

<body>
    <h1><?php echo $greetins; ?></h1>
    <div class="business-card">
        <div class="business-card-front">
            <div class="company-logo">
                <img src="images/Bulbasaur.jpg" alt="Bulbasaur">
            </div>
            <div class="first-name"><?php echo $firstName; ?></div>
            <div class="last-name"><?php echo $lastname; ?></div>
            <div class="age">Age: <?php echo $age; ?></div>
            <div class="profession"><?php echo $profession; ?></div>
        </div>
        <div class="business-card-back">
            <div class="company-name"><?php echo $companyName; ?></div>
            <div class="street">Street: <?php echo $street; ?></div>
            <div class="city">City: <?php echo $city; ?></div>
            <div class="post-number">Post number: <?php echo $postNumber; ?></div>
            <div class="phoneNumber">Phone number: <?php echo $phoneNumber; ?></div>
            <div class="email">Email: <?php echo $email; ?></div>
            <div class="website">Website: <?php echo $website; ?></div>
            <div class="isLookingForJob">Looking for job?: <?php echo $isLookingForJob ? 'Yes' : 'No'; ?></div>
        </div>
    </div>
</body>

</html>