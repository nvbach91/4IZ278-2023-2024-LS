<?php
$firstName = 'Vilém';
$lastName = 'Charwot';
$dateOfBirth = new DateTime('6/12/2002');

$position = 'Software Developer';
$companyName = 'charwot';

$address = ['Monkey Business',120,69,'Gorilla Town'];

$telephone = '+420 777 555 555';
$email = 'chav07@vse.cz';
$website = 'eso.vse.cz/~chav07/portfolio/';
$isLookingForJob = true;

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css"/>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Inter">

    <title>Charwot - Business Card</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico"/>
</head>
<body>
    <div class="main-wrapper">
        <h1 class="kokot">My Business Card</h1>

        <!--Front side-->
        <section class="card-side card-front">
            <div class="spacer"></div>
            <img id="logo" src="images/vizitka-logo.svg">
            <div class="front-side-bottom-part">
                <p class="text-bold-xl"><?php echo $firstName . ' ' . $lastName ?></p>
                <p class="text-normal-l"><?php echo $position ?></p>
            </div>
        </section>

        <!--Back side-->
        <section class="card-side card-back">
            
            <div class="back-col-1">
                <img src="images/vizitka-logo.svg" alt="logo">
                <p class="text-bold-m"><?php echo $firstName . ' ' . $lastName ?></p>
                <p class="text-normal-sm"><?php echo $position ?></p>
                <p class="text-normal-sm">Age <?php
                $currentDate = new DateTime('now');
                $difference = $dateOfBirth->diff($currentDate);
                 echo $difference->y; 
                 ?></p>
            </div>

            <div class="back-col-2">
                <div class="info-item">
                    <img class="icon" src="images/map-pin-outline.svg">
                    <div class="text-normal-sm">
                        <?php 
                        echo $address[0] . ' ' . $address[1] . '/'. $address[2] . ', ' . $address[3];
                        ?>
                    </div>
                </div>
                <div class="info-item">
                    <img class="icon" src="images/phone-outline.svg">
                    <div class="text-normal-sm">
                        <?php 
                        echo $telephone;
                        ?>
                    </div>
                </div>
                <div class="info-item">
                    <img class="icon" src="images/envelope-outline.svg">
                    <div class="text-normal-sm">
                        <?php 
                        echo $email;
                        ?>
                    </div>
                </div>
                <div class="info-item">
                    <img class="icon" src="images/globe-outline.svg">
                    <div class="text-normal-sm">
                        <?php 
                        echo $website;
                        ?>
                    </div>
                </div>
                <div class="info-item">
                <div class="info-item">
                    <div class="text-normal-sm">
                        <?php 
                        echo $isLookingForJob ? 'Now ready to get hired!' : 'Not looking for a job';
                        ?>
                    </div>
                </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>