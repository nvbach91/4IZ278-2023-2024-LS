<?php

$avatar = 'img/avatar.png';
$firstName = 'Terka';
$lastName = 'Lukešová';
$born = new DateTime('1997-10-06');
$job = 'Student';
$company = 'Prague University of Economics and Business';
$street = 'nám. W. Churchilla';
$houseNumber = 1938;
$orientationNumber = 4;
$city = 'Prague';
$phone = '+420 123 456 789';
$email = 'lukt03@vse.cz';
$website = 'eso.vse.cz/~lukt03';
$lookingForJob = false;

$address = "$street $houseNumber/$orientationNumber, $city";
$age = $born->diff(new DateTime())->format("%Y");
$websiteUrl = "https://$website";

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/style.css" rel="stylesheet">
        <title>My Business Card</title>
    </head>
    <body>
        <h1>My Business Card</h1>
        <div class="business-card">
            <div class="avatar"><img src="<?php echo $avatar; ?>"></div>
            <div class="first-name"><?php echo $firstName; ?></div>
            <div class="last-name"><?php echo $lastName; ?></div>
            <div class="age">Age: <?php echo $age; ?></div>
            <div class="job"><?php echo $job; ?></div>
            <div class="company"><?php echo $company; ?></div>
        </div>
        <div class="business-card">
            <h2>Where can you find me?</h2>
            <div class="address">&#x1F4EC; <?php echo $address; ?></div>
            <div class="phone">&#x1F4DE; <?php echo $phone; ?></div>
            <div class="email">&#x1F4E8; <?php echo $email; ?></div>
            <div class="website">&#x1F310; <a href="<?php echo $websiteUrl; ?>"><?php echo $website; ?></a></div>
            <div class="lookingForJob">&#x1F4BC; <?php echo $lookingForJob ? "Looking for a job" : "Not looking for a job"; ?></div>
        </div>
    </body>
</html>