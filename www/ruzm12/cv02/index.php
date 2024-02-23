<?php

require "./classes/Person.php";

$bgImageUrl = "https://image.slidesdocs.com/responsive-images/background/business-card-line-texture-white-fresh-business-card-powerpoint-background_8485d73f09__960_540.jpg";

$personArray = [];

$person1 = new Person("Martin", "Růžek", "11.11.2001", "Web dev", "Tesla", "Jindřišská", "355", "1", "Praha", "+420 123 456 789", "me@martinruzek.cz", "www.martinruzek.cz", true, "./img/logo.png");
$person2 = new Person("Elon", "Musk", "28.06.1971", "CEO", "Tesla", "Main Street", "420", "69", "Palo Alto", "(555) 555-1234", "elon@musk.com", "www.elonmusk.com", false, "https://www.freepnglogos.com/uploads/tesla-logo-png-27.png");
$person3 = new Person("Jeff", "Bezos", "12.01.1964", "CEO", "Amazon", "Right Street", "565", "78", "San Francisco", "(555) 787-4567", "jeff@bezos.com", "www.jeffbezos.com", false, "https://upload.wikimedia.org/wikipedia/commons/d/de/Amazon_icon.png");

$personArray[] = $person1;
$personArray[] = $person2;
$personArray[] = $person3;


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV02 - Business Cards</title>
    <link rel="stylesheet" href="./styles/style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/868ac28d90.js" crossorigin="anonymous"></script>
</head>

<body>

    <div class="wrapper">
        <?php foreach ($personArray as $person) :  ?>
            <div class="card" style="background-image: url(<?php echo $bgImageUrl ?>); background-size: cover;">
                <div class="row">
                    <div class="col">
                        <img src="<?php echo $person->getLogo() ?>" alt="Persons logo" class="card-logo">
                    </div>
                    <div class="col">
                        <div class="firstname"><?php echo $person->getFirstName() ?> </div>
                        <div class="lastname"><?php echo $person->getLastName() ?> </div>

                    </div>
                </div>
            </div>

            <div class="card" style="background-image: url(<?php echo $bgImageUrl ?>); background-size: cover;">
                <div class="row">
                    <div class="col">
                        <img src="<?php echo $person->getLogo() ?>" alt="Růžek logo" class="card-logo">
                    </div>
                    <div class="col">
                        <div class="card-text"><?php echo $person->getAge() . " years old" ?> </div>
                        <div class="card-text"><?php echo $person->getPosition() . " at " . $person->getCompany() ?> </div>
                        <div class="card-text"><?php echo $person->getPhone() ?></div>
                        <div class="card-text"><?php echo $person->getStreet() . " " . $person->getStreetNumber() . "/" . $person->getOrientionalNumber() . ", " . $person->getCity() ?></div>
                        <div class="card-text"><?php echo $person->getEmail() ?></div>
                        <div class="card-text"><?php echo $person->getWebsite() ?></div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>


    </div>


    <ul>

    </ul>
</body>

</html>