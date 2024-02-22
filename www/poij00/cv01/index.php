<?php

// odevzdat potom ve formatu xname-cvXX
$avatar = 'apple.png';
$heading = 'MY BUSINESS CARD IN PHP';
$firstName = 'Tim';
$lastName = 'Cook';
$dateOfBirth = new DateTime('1960-11-01');
$today = new DateTime();
$diff = date_diff($dateOfBirth, $today);
$age = $diff->y;
$company = 'Apple';
$position = 'Chief Executive Officer';
$address = '1 Apple Park Way, Cupertino';
$phone = '1-(833)-317-1755';
$email = 't.cook@apple.com';
$web = 'apple.com';
$contracts = false;
if ($contracts) {
    $job = 'Not available for contracts now';
} else {
    $job = 'Available for contracts now';
}
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
    <div class="container">
        <h1><?php echo $heading; ?></h1>
        <div class="business-card">
            <div class="column">
                <div class= "logo" style="background-image: url(./img/<?php echo $avatar; ?>)"></div>
            </div>
            <div class="column2">
                <div class="first-name"><?php echo $firstName; ?></div>
                <div class="last-name"><?php echo $lastName; ?></div>
                <div class="position"><?php echo $position; ?></div>
                <div class="company"><?php echo $company; ?></div>
            </div>
         
        </div>

        <div class="business-card">
            <div class="column2">
            <div class="first-name"><?php echo $firstName; ?></div>
                <div class="last-name"><?php echo $lastName; ?></div>
                <div class="company2"><?php echo $company; ?></div>
                <div class="position2"><?php echo $position; ?></div>
            </div>
            <div class="column2 border">
                <div class="info">Age: <?php echo $age; ?></div>
                <div class="info">Address: <?php echo $address; ?></div>
                <div class="info">Phone: <?php echo $phone; ?></div>
                <div class="info">Email: <?php echo $email; ?></div>
                <div class="info">Website: <?php echo $web; ?></div>
                <div class="info"><?php echo $job; ?></div>
                
            </div>
         
        </div>
    </div>
</body>
</html>

