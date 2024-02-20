<?php
/*

Příjmení
Jméno
Věk (výpočet z datumu narození)
Povolání nebo Pozice
Název firmy
Ulice
Číslo popisné
Číslo orientační
Město
Telefon
E-mail
Adresa webové stránky
Zda sháníte práci (Boolean)

*/

    $name = 'Martin';
    $surname = 'Fanta';
    $dob = '1999-08-26';
    $position = 'Sith Lord';
    $company = 'Galactic Empire';
    $street = 'Death Star Ave';
    $house_number = '123';
    $apt_number = '';
    $city = 'Imperial City';
    $phone = '123-456-7890';
    $email = 'martin.fanta@example.com';
    $website = 'www.empire.com';
    $looking_for_job = true;
    
    $birthdate = new DateTime($dob);
    $today = new DateTime('today');
    $age = $birthdate->diff($today)->y;

    $favourite_cars = [
        'Deathstar',
        'Executor',
        'Star Destroyer'
    ]
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Darth Vader Business Card</title>
<style>
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #333;
        color: #fff;
        text-align: center;
        padding: 20px;
    }
    .card {
        background-color: #000;
        padding: 20px;
        margin: 20px auto;
        width: 600px;
        height: 300px;
        box-shadow: 0px 0px 0px 0px #000;
    }
    .back {
        background-color: #333;
        margin-top: 20px;
    }
    h2 {
        color: #ff9800;
        font-size: 24px;
        margin-bottom: 5px;
    }
    p {
        font-size: 14px;
        color: #ccc;
        margin-bottom: 5px;
    }
    .label {
        color: #fff;
        font-weight: bold;
    }
    .value {
        color: #f44336;
        font-weight: bold;
    }

    .front-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }

    .front-left {
        align-items: center;
        justify-content: center;
    }

    .logo{
        width: 150px;
        margin-right: 70px;
    }

</style>
</head>
<body>
    <div class="card">
        <div class="front-container">
            <div class="front-left">
                <img class="logo" src="https://i.ebayimg.com/images/g/mR0AAOSwImRYJjtI/s-l1200.jpg">

            </div>
            <div class="front-right">
                <h2><?php echo $name . ' ' . $surname ?></h2>
                <p><span class="label">Position:</span> <span class="value"><?php echo $position ?></span></p>
                <p><span class="label">Company:</span> <span class="value"><?php echo $company ?></span></p>
            </div>
            
        </div>
    </div>

    <div class="card">
        <p><span class="label">Age:</span> <span class="value"><?php echo $age ?> years old</span></p>
            
        <p><span class="label">Address:</span> <span class="value"><?php echo $street . ' ' . $house_number . ($apt_number ? ', Apt ' . $apt_number : '') ?></span></p>
        <p><span class="label">City:</span> <span class="value"><?php echo $city ?></span></p>
        <p><span class="label">Phone:</span> <span class="value"><?php echo $phone ?></span></p>
        <p><span class="label">Email:</span> <span class="value"><?php echo $email ?></span></p>
        <p><span class="label">Website:</span> <span class="value"><?php echo $website ?></span></p>
        <p><span class="label">Looking for job:</span> <span class="value"><?php echo $looking_for_job ? 'Yes' : 'No' ?></span></p>
        
    <?php foreach ($favourite_cars as $car):?>
        <p><span class="label"><?php echo $car ?></span></p>
    <?php endforeach; ?>
    </div>
</body>
</html>
