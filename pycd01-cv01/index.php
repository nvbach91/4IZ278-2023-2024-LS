<?php


$avatar = './img/avatar.png';                 
$firstName = 'ZED';
$lastName = 'Master';
$age = 35;
$job = 'Assasin';
$company = 'Shadow order';
$street = 'Ionian';
$streetNum = 157;
$orientationNumber = 121;
$city = 'Kashuri';
$phone = '+150 189 159 178';
$email = 'zed@gmail.com';
$website = 'https://www.zed-assasination.com';
$lookingForJob = false;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Zed's business card</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <main>
        <div class="name-container">
        <h1><?php echo $lastName ?> <?php echo $firstName ?></h1>
        <img src="<?php echo $avatar ?>">
        </div>
        <div class="info-container">
            <ul>
                <li>Age: <?php echo $age ?></li>
                <li>Job: <?php echo $job ?></li>
                <li>Company: <?php echo $company ?></li>
                <li>Street: <?php echo $street ?></li>
                <li>Street Number: <?php echo $streetNum ?></li>
                <li>Orientation number: <?php echo $orientationNumber ?></li>
                <li>City: <?php echo $city ?></li>
                <li>Phone: <?php echo $phone ?></li>
                <li>E-mail: <?php echo $email ?></li>
                <li>Website: <a href="<?php echo $website ?>"><?php echo $website ?></a></li>
                <li>Am I looking for job? <?php echo $res = ($lookingForJob == true) ? 'yes' : 'no' ;  ?></li>
            </ul>
        </div>
    </main>
</body>

</html>