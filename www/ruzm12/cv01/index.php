<?php

$firstName = "Martin";
$lastName = "Růžek";
$age  = 52;
$dateOfBirth = date("d.m.o", strtotime("11.11.2001"));
$age = date_diff(date_create($dateOfBirth), date_create('today'))->y;
$isMarried = true;
$favCars = ["Tesla Model S", "Tesla Model X", "Tesla Model 3", "Tesla Model Y"];
$accounts = [
    "facebook" => "https://www.facebook.com/elonmusk",
    "twitter" => "https://www.twitter.com/elonmusk",
    "instagram" => "https://www.instagram.com/elonmusk"
];
$bgImageUrl = "https://image.slidesdocs.com/responsive-images/background/business-card-line-texture-white-fresh-business-card-powerpoint-background_8485d73f09__960_540.jpg";
$position = "Web dev";
$company = "Tesla";
$street = "Jindřišská";
$streetNumber = "355";
$orientionalNumber = "1";
$city = "Praha";
$phone = "+420 123 456 789";
$email = "me@martinruzek.cz";
$website = "www.martinruzek.cz";
$jobHunting = true;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gloock&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/868ac28d90.js" crossorigin="anonymous"></script>
</head>

<body>

    <div class="wrapper">
        <div class="card" style="background-image: url(<?php echo $bgImageUrl ?>); background-size: cover;">
            <div class="row">
                <div class="col">
                    <img src="./img/logo.png" alt="Růžek logo" class="card-logo">
                </div>
                <div class="col">
                    <div class="firstname"><?php echo $firstName ?> </div>
                    <div class="lastname"><?php echo $lastName ?> </div>

                </div>
                <!--<div class="firstname"><?php echo $firstName ?></div>
                <div class="lastname"><?php echo $lastName ?></div>
                <div class="age"><?php echo $age ?></div>-->
            </div>
        </div>

        <div class="card" style="background-image: url(<?php echo $bgImageUrl ?>); background-size: cover;">
            <div class="row">
                <div class="col">
                    <img src="./img/logo.png" alt="Růžek logo" class="card-logo">
                </div>
                <div class="col">
                    <div class="card-text"><?php echo $age . " years old" ?> </div>
                    <div class="card-text"><?php echo $position . " at " . $company ?> </div>
                    <div class="card-text"><?php echo $phone ?></div>
                    <div class="card-text"><?php echo $street . " " . $streetNumber . "/" . $orientionalNumber . ", " . $city ?></div>
                    <div class="card-text"><?php echo $email ?></div>
                    <div class="card-text"><?php echo $website ?></div>
                </div>
                <!--<div class="firstname"><?php echo $firstName ?></div>
                <div class="lastname"><?php echo $lastName ?></div>
                <div class="age"><?php echo $age ?></div>-->
            </div>
        </div>
    </div>


    <ul>
        <?php foreach ($favCars as $car) :  ?>
            <li><?php echo $car ?></li>
        <?php endforeach; ?>
    </ul>
</body>

</html>