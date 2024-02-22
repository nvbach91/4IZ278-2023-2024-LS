<?php

$avatar = 'logo.png';
$cardTemplateFront = 'cardTemplateFront.jpg';
$cardTemplateBack = 'cardTemplateBack.jpg';
$firstName = 'Geralt';
$middleName = 'of';
$lastName = 'Rivia';
$alias = 'White Wolf';
$title = 'Witcher';
$company = 'School of the Wolf';
$street = "The Witcher's Keep";
$propertyNumber = 42;
$orientationNumber = 42024;
$city = 'Kaer Morhen';
$email = 'white.wolf@kaermorhen.com';
$phone = '+420 777 888 999';
$available = true;
$birthYear = 1174;
$nowYear = 1272;

$age = $nowYear - $birthYear;
$address = "$street $propertyNumber/$orientationNumber, $city ";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Business card</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Uncial+Antiqua&family=Cinzel:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="headline text-center">Business Card</div>
    <div class="container">
        <div class="business-card bc-front row" style="background-image: url(./img/<?php echo $cardTemplateFront; ?>)">
            <div class="col-5">
                <div class="bc-avatar" style="background-image: url(./img/<?php echo $avatar; ?>)"></div>
            </div>
            <div class="col-6">
                <div class="bc-name"><?php echo "$firstName $middleName $lastName"; ?></div>
                <div class="bc-alias"><?php echo $alias; ?></div>
                <div class="bc-title"><?php echo $title; ?></div>
                <div class="bc-company"><?php echo $company; ?></div>
            </div>
        </div>
        <div class="business-card bc-back row" style="background-image: url(./img/<?php echo $cardTemplateBack; ?>)">
            <div class="col">
                <div class="bc-name"><?php echo "$firstName $middleName $lastName"; ?></div>
                <div class="bc-age"><?php echo "$age y/o"; ?></div>
                <div class="bc-title"><?php echo $title; ?></div>
            </div>
            <div class="col contacts">
                <div class="bc-address"><?php echo "$address"; ?></div>
                <div class="bc-phone"><?php echo "$phone"; ?></div>
                <div class="bc-email"><?php echo "$email"; ?></div>
                <div class="bc-available"><?php echo $available ? 'Now available for contracts' : 'Not available for contracts'; ?></div>
            </div>
        </div>
    </div>
</body>
</html>