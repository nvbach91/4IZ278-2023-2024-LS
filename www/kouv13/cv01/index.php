<?php
$logo = 'logo.png';
$firstName = 'Vojtěch';
$lastName = 'Koubek';
$title = 'Grafický designer';
$companyName = 'Huleba Praha';
$phone = '+420 777 666 555';
$email = 'koubek@hulebapraha.cz';
$website = 'www.hulebapraha.cz';
$avaible = false;
$companyStreet = 'Ke Hrádku';
$companyPropertyNumber = 6;
$companyOrientationNumber = 14200;
$companyCity = 'Praha';
$birthdate = new DateTime('2003-01-01');
$today = new DateTime(date('Y-m-d'));

$difference = $today->diff($birthdate);

$age = $difference->y;


$address = $companyStreet . ' ' . $companyPropertyNumber . ', ' . $companyCity . ' ' . $companyOrientationNumber;

$jobMessage = $avaible ? 'momentálně shaním práci' : 'momentálně neshaním práci';


$name = $firstName . ' ' .  $lastName;
?>

<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vizitka</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body>
    <main class="row justify-content-center">
        <h1>Moje vizitka</h1>
        <section class="row col cards">
            <div class="col-12 row my-card" id="front">
                <div class="col-9">
                    <h2 class="name"><?php echo $name; ?></h2>
                    <p><?php echo $title . ' | ' . $jobMessage; ?></p>
                </div>
                <div class="col-3 text-end">
                    <img src="<?php echo $logo;  ?>" alt="logo" class="w-75">
                </div>
                <div class="col-12 personal-info align-self-end">
                    <p>
                    <?php echo $age; ?> let
                    </p>
                    <p>
                    <?php echo $email; ?>
                    </p>
                    <p>
                    <?php echo $phone; ?>
                    </p>
                </div>
            </div>
            <div class="col-12 my-card row" id="back">
                <div class="col-12 company-info align-self-center">
                    <h3>
                    <?php echo strtoupper($companyName);  ?>
                    </h3>
                    <p class="mb-5">
                    <?php echo $address;  ?>
                    </p>
                    <a href="https://<?php echo $website;  ?>" target="_blank">
                    <?php echo $website;  ?>
</a>
                </div>
            </div>
        </section>
    </main>
</body>

</html>