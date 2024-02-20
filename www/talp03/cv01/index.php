<?php
$greetings = 'My business card';
$avatar = './img/cross.jpg';
$name = 'Jesus';
$lastName = 'Christ';
$age = date("Y") - 1991;
$position = 'Son of God';
$companyName = 'Kingdom of Heaven';
$adress = 'Gates of Heaven 01, Heavens, 000 01';
$mobileNumber = '+420 543 670 832';
$email = 'sonofgod@heavens.com';
$lookingForJob = 'Open to new opportunities';
?> 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Business card</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <h1><?php echo $greetings?></h1>
    <div class="business-card-wrapper">
        <div class="bussiness-card-front">
            <div class="avatar">
                <img src="<?php echo $avatar; ?>" alt="avatar">
            </div>
            <div class="front-wrapper">
                <div class="first-name"><?php echo $name?></div>
                <div class="last-name"><?php echo $lastName?></div>
                <div class="position"><?php echo $position?></div>
                <div class="company"><?php echo $companyName?></div>
            </div>
        </div>
        <div class="bussiness-card-back">
            <div class="back-wrapper">
                <div class="first-name"><?php echo $name?></div>
                <div class="last-name"><?php echo $lastName?></div>
                <div class="position"><?php echo $position?></div>
            </div>
            <div class="other-info-wrapper">
                <div class="adress"><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $adress?></div>
                <div class="age"><i class="fa fa-birthday-cake" aria-hidden="true"></i><?php echo $age?></div>
                <div class="mobile-number"><i class="fa fa-phone" aria-hidden="true"></i><?php echo $mobileNumber?></div>
                <div class="email"><i class="fa fa-envelope" aria-hidden="true"></i><?php echo $email?></div>
                <div class="looking-for-job"><?php echo $lookingForJob?></div>
            </div>
        </div>
    </div>
</body
</html>