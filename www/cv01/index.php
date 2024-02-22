<?php
$greetings = 'Make it so!';
$logo = "https://upload.wikimedia.org/wikipedia/commons/thumb/4/49/Starfleet_Combadge_TNG.svg/1942px-Starfleet_Combadge_TNG.svg.png";
$backgroundImage = "https://wallpapers.com/images/hd/business-card-background-588tmswvrvxi1n75.jpg";
// name
$lastName = 'Picard';
$firstName = 'Jean-Luc';
$dateOfBirth = "2305-07-13";
// substracting 340 years
$dateOfBirthObject = new DateTime($dateOfBirth);
$dateOfBirthObject->modify("-340 years");
// current date
$currentDate = date("Y-m-d");
// calculating age
$currentDateObject = new DateTime($currentDate);
$age = $dateOfBirthObject->diff($currentDateObject)->y;
// job
$job = 'Captain';
$companyName = 'Starfleet';
$commandShips = ['USS Enterprise-D', 'USS Enterprise-E'];
// address
$streetName = 'Federation Drive';
$streetNumber = 24;
$evidenceNumber = 593;
$city = 'San Francisco';
// contact
$phone = '(209) 300-2557';
$email = 'picard@starleet.ufp';
$webURL = 'captain.picard.startrek.ufp';
$isLokkingForJob = false;
$isLokkingForJobStatus = $isLokkingForJob ? "Is" : "Not";
?>


<!DOCTYPE html>
<html>

<head>
    <title>cv01</title>
    <link rel="stylesheet" href="./CSS/styles.css">
</head>
<!-- http://localhost/4iz278-2023-2024/www/cv01/  
     https://github.com/nvbach91/4IZ278-2023-2024-LS/wiki/LAB01 -->

<body>
    <main>
        <h1><?php echo $greetings; ?></h1>
        <div class="front" style="background-image: url(<?php echo $backgroundImage ?>)">
            <div class="frontLeft">
                <img src="<?php echo $logo; ?>" alt="starfleet badge" width="50px">
            </div>
            <div class="frontRight">
                <div class="name">
                    <div class='first-name'><?php echo $firstName; ?></div>
                    <div class='last-name'><?php echo $lastName; ?></div>
                </div>
                <div class='company'><?php echo $companyName; ?></div>
                <div class='rank'><?php echo $job; ?></div>
                <div class='ships'>
                    <?php foreach ($commandShips as $ship) : ?>
                        <div><?php echo $ship; ?></div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="back" style="background-image: url(<?php echo $backgroundImage ?>)">
            <div class="backLeft">
                <div class="name">
                    <div class='first-name'><?php echo $firstName; ?></div>
                    <div class='last-name'><?php echo $lastName; ?></div>
                </div>
                <div class="date-age">
                    <div class='birth-date'><?php echo $dateOfBirth; ?></div>
                    <div class='age'>(<?php echo $age; ?>)</div>
                </div>
                <div class='company'><?php echo $companyName; ?></div>
                <div class='rank'><?php echo $job; ?></div>
                <div class='ships'>
                    <?php foreach ($commandShips as $ship) : ?>
                        <div><?php echo $ship; ?></div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="backRight">
                <div class='address'><?php echo $streetName; ?> <?php echo $streetNumber; ?>/<?php echo $evidenceNumber; ?>, <?php echo $city; ?></div>
                <div class="contact">
                    <ul>
                        <li class="phone"><?php echo $phone; ?></li>
                        <li class="email"><?php echo $email; ?></li>
                        <li class="web"><?php echo $webURL; ?></li>
                    </ul>
                </div>
                <div class='available'><?php echo $isLokkingForJobStatus; ?> looking for work.</div>
            </div>
        </div>
    </main>
</body>

</html>