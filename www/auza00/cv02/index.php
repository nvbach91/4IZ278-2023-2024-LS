<?php
    require './classes/Person.php';

    $anakin = new Person(
        'https://1000logos.net/wp-content/uploads/2023/06/Jedi-Logo.png',
        'Anakin', 
        'Skywalker',
        'Lead Developer / Architect',
        'First Order Jedi Council',
        '+420 777 888 999',
        'skywalker@jedi-council.com',
        'www.jedi-council.com',
        false,
        'Temple of Eedit',
        42,
        121,
        'Coruscant',
        1217412.420,
        'CZK',
        666,
        date('Y')
    );

    $cheech = new Person(
        'https://cdn.pixabay.com/photo/2021/03/02/23/15/marijuana-6064075_960_720.png',
        'Cheech', 
        'Chong',
        'Lead Stoner',
        'HotBox',
        '+420 420 024 420',
        'cheech.chong@.joint.us',
        'https://eso.vse.cz/~auza00/Stubchaser/',
        false,
        'High Street',
        420,
        024,
        'Amsterdam',
        420420.420,
        'USD',
        420,
        date('Y')
    );

    $adam = new Person(
        'https://cdn.pixabay.com/photo/2021/03/02/23/15/marijuana-6064075_960_720.png',
        'Adam', 
        'Auzký',
        'Divadelní technik',
        'Studio HRdinů',
        '+420 606 045 845',
        'a.auzky@gmail.com',
        'https://eso.vse.cz/~auza00/Stubchaser/',
        true,
        'Nad Sýpkou',
        020,
        64000,
        'Prague',
        13,
        'CZK',
        2003,
        date('Y')
    );

    $people = [];
    array_push($people, $anakin);
    array_push($people, $cheech);
    array_push($people, $adam);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Business card</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <main class="container">
        <h1 class="text-center">My Business Card in PHP</h1>
        <?php foreach($people as $person): ?>
        <div class="business-card bc-front row">
            <div class="col-sm-4">
                <div class="logo" style="background-image: url(./img/<?php echo $person->avatar; ?>)"></div>
            </div>
            <div class="col-sm-8">
                <div class="bc-firstname"><?php echo $person->firstName; ?></div>
                <div class="bc-lastname"><?php echo $person->lastName; ?></div>
                <div class="bc-title"><?php echo $person->title; ?></div>
                <div class="bc-company"><?php echo $person->company; ?></div>
            </div>
        </div>
        <div class="business-card bc-back row">
            <div class="col-sm-6">
                <div class="bc-firstname"><?php echo $person->firstName; ?></div>
                <div class="bc-lastname"><?php echo $person->lastName; ?></div>
                <div class="bc-title"><?php echo $person->title ?></div>
            </div>
            <div class="col-sm-6 contacts">
                <div class="bc-address"><i class="fas fa-map-marker-alt"></i> <?php echo $person->getAddress(); ?></div>
                <div class="bc-phone"><i class="fas fa-phone"></i> <?php echo $person->phone; ?></div>
                <div class="bc-email"><i class="fas fa-at"></i> <?php echo $person->email; ?></div>
                <div class="bc-website"><i class="fas fa-globe"></i> <?php echo $person->website; ?></div>
                <div class="bc-available"><?php echo $person->available ? 'Not available for contracts' : 'Now available for contracts'; ?></div>
                <div class="bc-age">Age: <?php echo $person->getAge()?></div>
                <div class="bc-full_name">Full name: <?php echo $person->getFullName()?></div>
            </div>
        </div>
        <?php endforeach; ?>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"></script>
</body>

</html>