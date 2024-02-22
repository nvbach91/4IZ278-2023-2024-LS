<?php
$firstName = "Linh";
$lastName = "Le";
$dateOfBirth = new DateTimeImmutable("1995-01-20");
$age = $dateOfBirth->diff(new DateTimeImmutable())->y;
$role = "Frontend Engineer";
$company = [
    "name" => "Mews",
    "address" => [
        "streetName" => "nám. I. P. Pavlova",
        "streetNumber" => "5",
        "city" => "Praha",
        "zip" => "120 00"
    ],
    "website" => "https://www.mews.com",
];
$phone = "+420 123 456 789";
$email = "linh.le@mews.com";
$lookingForWork = false;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <link rel="stylesheet" href="css/main.css">
    <script src="https://kit.fontawesome.com/f4273ed2c8.js" crossorigin="anonymous"></script>
    <title>cv01</title>
</head>

<body>
    <div class='business-card-covers'>
        <div class='business-card business-card-front'>
            <div class="brand">
                <img src="https://www.mews.com/hs-fs/hubfs/mews-logo-2020.png?width=2088&name=mews-logo-2020.png" alt="Logo">
            </div>
            <div class="company-info">
                <p><i class="fa-solid fa-location-dot"></i> <?php echo $company["address"]["streetName"] . " " . $company["address"]["streetNumber"] . ", " . $company["address"]["city"] . ", " . $company["address"]["zip"]; ?></p>
                <p><i class="fa-solid fa-globe"></i> <a href="<?php echo $company["website"]; ?>">mews.com</a></p>
            </div>
        </div>
        <div class='business-card business-card-back'>
            <div class="person-info">
                <h1><?php echo $firstName; ?> <?php echo $lastName; ?></h1>
                <h2 class="role"><?php echo $role; ?></h2>
                <hr class="divider">
                <p><i class="fa-solid fa-cake-candles"></i> <?php echo $dateOfBirth->format('d.m.Y'); ?></p>
                <p><i class="fa-solid fa-hourglass-half"></i> <?php echo $age; ?> years</p>
                <p><i class="fa-solid fa-at"></i> <a href="mailto:linh.le@mews.com"><?php echo $email; ?></a></p>
                <p><i class=" fa-solid fa-phone"></i> <?php echo $phone; ?></p>
            </div>
            <div class="brand">
                <img src="https://www.mews.com/hs-fs/hubfs/mews-logo-2020.png?width=2088&name=mews-logo-2020.png" alt="Logo">
            </div>
        </div>
    </div>
</body>

</html>