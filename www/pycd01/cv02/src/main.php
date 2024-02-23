<?php
require('./classes/Person.php'); 
require('./utils/person_func.php'); 

$zed = new Person(
    $avatar = './img/zed.png',
    $firstName = 'ZED',
    $lastName = 'Master',
    $birthDate = '21.2.2000',
    $job = 'Assasin',
    $company = 'Shadow order',
    $street = 'Ionian',
    $streetNum = 157,
    $orientationNumber = 121,
    $city = 'Kashuri',
    $phone = '+150 189 159 178',
    $email = 'zed@gmail.com',
    $website = 'https://www.zed-assasination.com',
    $lookingForJob = false,
);

$kayn = new Person(
    $avatar = './img/kayn.png',
    $firstName = 'Shieda',
    $lastName = 'Kayn',
    $birthDate = '21.2.2002',
    $job = 'Assasin',
    $company = 'Shadow order',
    $street = 'Ionian',
    $streetNum = 157,
    $orientationNumber = 121,
    $city = 'Kashuri',
    $phone = '+150 189 159 178',
    $email = 'kayn@email.com',
    $website = 'https://www.kayn.com',
    $lookingForJob = true,
);

$aurelion = new Person(
    $avatar = './img/aurelion.png',
    $firstName = 'Aurelion',
    $lastName = 'Sol',
    $birthDate = '21.2.1',
    $job = 'Space Creature',
    $company = 'Space org.',
    $street = 'Boulevard of Milky way',
    $streetNum = 981,
    $orientationNumber = 95,
    $city = 'Universe',
    $phone = '+150 189 111 655',
    $email = 'aurelion@sol.com',
    $website = 'https://www.aurelion-sol.net',
    $lookingForJob = false,
);

$characters = [];
array_push($characters, $zed);
array_push($characters, $kayn);
array_push($characters, $aurelion);
?>
<?php foreach($characters as $character): ?>
<div class="card <?php echo $character->firstName ?>">
    <div class="front-container">
        <img src="<?php echo $character->avatar ?>" alt="avatar">
        <div>
            <h1><?php echo getFullName($character) ?></h1>
        </div>
    </div>
    <div class="back-container">
        <div class="name">
            <h1><?php echo getFullName($character) ?></h1>
        </div>
        <div class="info">
            <ul>
                <li>Age: <?php echo getAge($character) ?></li>
                <li>Job: <?php echo $character->job ?></li>
                <li>
                    <address> Address: <?php echo getAddress($character) ?> </address>
                </li>
                <li>Phone: <?php echo $character->phone ?></li>
                <li>E-mail: <?php echo $character->email ?></li>
                <li>Website: <a href="<?php echo $character->website ?>"><?php echo $character->website ?></a></li>
                <li>Am I looking for job? <?php echo ($character->lookingForJob == true) ? 'yes' : 'no';  ?></li>
            </ul>
        </div>
    </div>
</div>
<?php endforeach; ?>