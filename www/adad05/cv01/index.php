<?php
$greetings = 'Business Card';
$name = 'Homer';
$lastName = 'Simpson';
$age = 42;    // int, double, float
$isMarried = true; // boolean; true / false
$occupation = 'nuclear safety inspector';
$companyName = 'Springfield Nuclear Power Plant';
$street = 'Industrial Way';
$streetCode = '100';
$sector = '7G';
$city = 'Springfield';
$number = '+420 777 888 999';
$email = 'NPP@springfield.com';
$website = 'springfieldNPP.com';
$lookingForJob = false;
$logo = './img/logo.png';
$logoBack = './img/logo-back.png';
$businessCardBackgroudImageUrl = './img/background.jpeg';
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
    <div class="business-card" style="background-image: url(<?php echo $businessCardBackgroudImageUrl ?>)">
        <div class="row">
            <div class="left">
                <img class="logo" src=<?php echo $logo ?>>
            </div>
            <div class="right">
                <div class="first-name"><?php echo $name; ?></div>
                <div class="last-name"><?php echo $lastName; ?></div>
                <div class="age"> Age: <?php echo $age; ?></div>
                <div class="is-married"> Status: <?php if ($isMarried) {
                                                        echo 'Married';
                                                    } else echo 'Single' ?></div>
            </div>
        </div>
    </div>

    <div class="business-card" style="background-image: url(<?php echo $businessCardBackgroudImageUrl ?>)">
        <div class="row">
            <div class="left-back">
                <div class="default-text"> Street: <?php echo $street; ?></div>
                <div class="default-text"> Street number: <?php echo $streetCode; ?></div>
                <div class="default-text"> Sector: <?php echo $sector; ?></div>
                <div class="default-text"> City: <?php echo $city; ?></div>
                <div class="default-text"> Telephone: <?php echo $number; ?></div>
                <div class="default-text"> Email: <?php echo $email; ?></div>
                <div class="default-text"> Website: <?php echo $website; ?></div>
                <div class="default-text"> Looking for job: <?php if ($lookingForJob) {
                                                                echo 'Yes';
                                                            } else echo 'No' ?></div>
            </div>
            <div class="right-back">
                <img class="logo-back" src=<?php echo $logoBack ?>>
            </div>
        </div>
    </div>
</body>

</html>