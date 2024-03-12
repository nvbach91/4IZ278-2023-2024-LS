<?php
$firstName = "Taylor";
$lastName = "Otwell";
$age = 37;
$job = "Founder, CEO, Lambo guy";
$companyName = "Laravel";
$streetName = "Pebble Beach Dr";
$streetNumber = 4908;
$referenceNumber = 7744;
$city = "Benton";
$phoneNumber = "777 777 777";
$email = "otwell@laravel.com";
$web = "https://laravel.com/";
$lookingForJob = false;
$businessCardBackgroundUrl = "https://i2.wp.com/files.123freevectors.com/wp-content/original/205164-neon-green-wave-business-card-background-graphic.jpg?w=500&q=95";
$avatarUrl = "https://avatars.githubusercontent.com/u/463230?v=4";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business card 👔</title>
    <link rel="stylesheet" href="./css/main.css">
</head>
<body>
<div class="business-card-container">
        <div class="business-card" style="background-image: url(<?php echo $businessCardBackgroundUrl; ?>);">
            <div class="profile">
                <img class="avatar" src="<?php echo $avatarUrl; ?>" alt="avatar">
                <div class="name-and-job">
                    <div class="name">
                        <div class="first-name"><?php echo $firstName;?></div>
                        <div class="last-name"><?php echo $lastName;?></div>
                    </div>
                    <div lass="job"><?php echo $job;?></div>
                </div>
            </div>
            <div class="company-name"><?php echo $companyName;?></div>
            <div class="contact-info">
                <div class="phone-number"><?php echo $phoneNumber;?></div>
                <div class="email"><?php echo $email;?></div>
                <div class="web"><?php echo $web;?></div>
            </div>
            <div class="address">
                <div class="street"><?php echo $streetName . ' ' . $streetNumber;?></div>
                <div class="reference-number"><?php echo $referenceNumber;?></div>
                <div class="city"><?php echo $city;?></div>
            </div>
            <div class="looking-for-job"><?php echo $lookingForJob ? 'I am looking for a job!' : 'I am not looking for a job'; ?></div>
    </div>
</div>
</body>
</html>
