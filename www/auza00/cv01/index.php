<?php
    $greetings = 'Hell world!';
    $firstName = 'Cheech'; // string
    $lastName = 'Chong';
    $age = '420'; // int/double/float
    $isMarried = false; // true/false
    $favouriteCars  = ["Ferrari", "Škoda"];
    $accounts = [
        'main' => 'Main Bank America',
        'secondary' => 'Chinese Bank',
        'secret' => 'ALJASKA secret bank'
    ];
    $businessCardBackgroundImage = 'https://img.freepik.com/free-vector/realistic-cannabis-leaf-background_23-2148785600.jpg';
    
    $businessCardLogo = 'https://eso.vse.cz/~auza00/Stubchaser/img/LOGO_i.png';
    $profession = 'technician';
    $firm = 'Studio Hrdinů';
    $street = 'Dukelských hrdinů';
    $houseNumber = '47';
    $streetNumber = '420';
    $city = 'Prague';
    $phoneNumber = '420024420';
    $email = 'cheech.chong@.joint.us';
    $webAddress = 'https://eso.vse.cz/~auza00/Stubchaser/';
    $seekingJob = false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV 01</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div class="business-card" style='background-image: url(<?php echo $businessCardBackgroundImage; ?>)'>
        <img id='business-logo' src='<?php echo $businessCardLogo; ?>'>
        <div class="first-name"><?php echo $firstName; ?></div>
        <div class="last-name"><?php echo $lastName; ?></div>
        <div class="age">age: <?php echo $age; ?></div>

        <div class="bottom">
            <div class="favourite-cars">
                <h3>Favourite cars</h3>
                <ul>
                    <?php foreach($favouriteCars as $car): ?>
                        <li><?php echo $car; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="accounts">
                <h3>Bank accounts</h3>
                <div><?php echo $accounts['main']; ?></div>
                <div><?php echo $accounts['secondary']; ?></div>
                <div><?php echo $accounts['secret']; ?></div>
            </div>            
        </div>

    </div>
    <div class="business-card" style='background-image: url(<?php echo $businessCardBackgroundImage; ?>)'>
        <div class="info">Proffesion: <?php echo $profession; ?></div>
        <div class="info">Firm: <?php echo $firm; ?></div>
        <div class="info">Street: <?php echo $street; ?></div>
        <div class="info">House number: <?php echo $houseNumber; ?></div>
        <div class="info">Street number: <?php echo $streetNumber; ?></div>
        <div class="info">City: <?php echo $city; ?></div>
        <div class="info">Phone number: <?php echo $phoneNumber; ?></div>
        <div class="info">Email: <?php echo $email; ?></div>
        <div class="info">Website: <?php echo $webAddress; ?></div>
        <div class="info">Seeking job: <?php echo $seekingJob; ?></div>
    </div>
</body>
</html>