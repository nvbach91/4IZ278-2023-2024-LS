<?php 

require './classes/person.php';

$jesus = new Person(
    './img/cross.jpg',
    'Jesus',
    'Christ',
    1991,
    'Son of God',
    'Heavens',
    'Gates of Heaven 01, Heavens, 000 01',
    '+420 543 670 832',
    'sonofgod@heavens.com',
    'Open to new opportunities',
);

$father = new Person(
    './img/father.jpg',
    'Heavenly',
    'Father',
    0,
    'Creator',
    'Heavens',
    'Gates of Heaven 01, Heavens, 000 01',
    '+420 567 123 098',
    'father@heavens.com',
    'Open to new opportunities',
);

$holySpirit = new Person(
    './img/holyspirit.jpg',
    'Holy',
    'Spirit',
    INF,
    'Comforter',
    'Heavens',
    'Gates of Heaven 01, Heavens, 000 01',
    '+420 987 654 345',
    'spirit@heavens.com',
    'Open to new opportunities',
);


$people = [];
array_push($people, $jesus);
array_push($people, $father);
array_push($people, $holySpirit)

?>

    <ul class="card-list">
        <?php foreach($people as $person): ?>
            <li class="card-element">
                <div class="business-card-wrapper">
                    <div class="bussiness-card-front">
                        <div class="avatar">
                            <img src="<?php echo $person->avatar; ?>" alt="avatar">
                        </div>
                        <div class="front-wrapper">
                            <div class="first-name"><?php echo $person->firstName?></div>
                            <div class="last-name"><?php echo $person->lastName?></div>
                            <div class="position"><?php echo $person->position?></div>
                            <div class="company"><?php echo $person->companyName?></div>
                        </div>
                    </div>
                    <div class="bussiness-card-back">
                        <div class="back-wrapper">
                            <div class="first-name"><?php echo $person->firstName?></div>
                            <div class="last-name"><?php echo $person->lastName?></div>
                            <div class="position"><?php echo $person->position?></div>
                        </div>
                        <div class="other-info-wrapper">
                            <div class="adress"><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $person->adress?></div>
                            <div class="age"><i class="fa fa-birthday-cake" aria-hidden="true"></i><?php echo $person->getAge()?></div>
                            <div class="mobile-number"><i class="fa fa-phone" aria-hidden="true"></i><?php echo $person->mobileNumber?></div>
                            <div class="email"><i class="fa fa-envelope" aria-hidden="true"></i><?php echo $person->email?></div>
                            <div class="looking-for-job"><?php echo $person->lookingForJob?></div>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>