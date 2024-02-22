<?php

$logo = 'logo.png';
$name = 'Burn underneath the rain';
$age = 2023;
$position = 'Band';
$firm = 'Metalcore';
$street = 'Plynární';
$streetnum1 = 1096;
$streetnum2 = 23;
$city = 'Prague';
$phonenum = +420735845678;
$email = 'burn.under@rain.com';
$webpage =  'http://www.burn-under.net/';
$available = true;

$address = $street . ' ' . $streetnum1 . '/' . $streetnum2 . ', ' . $city;

// string variable interpolation
$address = "$street $streetnum1/$streetnum2, $city";
$address = "{$street} {$streetnum1}/{$streetnum2}, {$city}";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Card</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <div class="card">
        <div class="first-side">
            <div class="logo">
                <img src="<?php echo $logo; ?>" alt="Logo" class="avatar">
            </div>
            <div class="info">
                <h2 id="name"><?php echo $name; ?></h2>
                <p id="age">Our years of experience: <?php echo 2024 - $age; ?></p>
                <p id="position"> <?php echo $position; ?> / <?php echo $firm; ?></p>
            </div>
        </div>  
        <div class="second-side">      
            <p id="address">Address: <?php echo $address; ?></p>
            <p id="phone">Phone: <?php echo $phonenum; ?></p>
            <p id="email">Email: <?php echo $email; ?></p>
            <p id="website">Website: <a href="<?php echo $webpage; ?>"><?php echo $webpage; ?></a></p>
            <p id="job">Available for shows: <?php echo $available ? 'Yes' : 'No'; ?></p>
        </div>
    </div>
</body>


</html>