<?php

require './classes/Person.php'; //import třídy z jiné složky

// uložení do proměnné
$picard = new Person(
    'https://upload.wikimedia.org/wikipedia/commons/thumb/4/49/Starfleet_Combadge_TNG.svg/1942px-Starfleet_Combadge_TNG.svg.png',
    './assets/red.jpg',
    // name
    'Picard',
    'Jean-Luc',
    "2305-07-13",
    // job
    'Captain',
    'Starfleet',
    ['USS Enterprise-D', 'USS Enterprise-E'],
    // address
    'Federation Drive',
    24,
    593,
    'San Francisco',
    // contact
    '(209) 300-2557',
    'picard@starleet.ufp',
    'captain.picard.startrek.ufp',
    false
);

$dax = new Person(
    'https://upload.wikimedia.org/wikipedia/commons/thumb/4/49/Starfleet_Combadge_TNG.svg/1942px-Starfleet_Combadge_TNG.svg.png',
    './assets/blue.jpg',
    // name
    'Dax',
    'Jadzia',
    "2341-03-28",
    // job
    'Chief Science Ofc.',
    'Starfleet',
    ['Deep Space Nine'],
    // address
    'Federation Drive',
    24,
    593,
    'San Francisco',
    // contact
    '(209) 300-2312',
    'jadzia.dax@starleet.ufp',
    'jadzia.dax.ufp',
    false
);

$obrien = new Person(
    'https://upload.wikimedia.org/wikipedia/commons/thumb/4/49/Starfleet_Combadge_TNG.svg/1942px-Starfleet_Combadge_TNG.svg.png',
    './assets/yellow.jpg',
    // name
    'O&#39;Brien',
    'Miles',
    "2328-09-01",
    // job
    'Chief Operations Ofc.',
    'Starfleet',
    ['Deep Space Nine'],
    // address
    'Federation Drive',
    24,
    593,
    'San Francisco',
    // contact
    '(209) 300-1824',
    'o&#39;brien@starleet.ufp',
    'chief.operations-office.ds9.ufp',
    false
);


// test zobrazení
// echo $pikachu->getType();

$persons = [];
array_push($persons, $picard);
array_push($persons, $dax);
array_push($persons, $obrien);


?>

<?php foreach ($persons as $person) : ?>
    <div class="card">
        <div class="front" style="background-image: url('<?php echo $person->backgroundImage; ?>')">
            <div class="frontLeft">
                <img src="<?php echo $person->logo; ?>" alt="starfleet badge" width="50">
            </div>
            <div class="frontRight">
                <div class="name"><?php echo $person->getFullName(); ?></div>
                <div class="company"><?php echo $person->companyName; ?></div>
                <div class="rank"><?php echo $person->job; ?></div>
                <div class="ships">
                    <?php foreach ($person->commandShips as $ship) : ?>
                        <div><?php echo $ship; ?></div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="back" style="background-image: url(<?php echo $person->backgroundImage; ?>)">
            <div class="backLeft">
                <div class="name">
                    <div class="name"><?php echo $person->getFullName(); ?></div>
                </div>
                <div class="date-age">
                    <div class="birth-date"><?php echo $person->dateOfBirth; ?></div>
                    <div class="age">(<?php echo $person->getAge(); ?>)</div>
                </div>
                <div class="company"><?php echo $person->companyName; ?></div>
                <div class="rank"><?php echo $person->job; ?></div>
                <div class="ships">
                    <?php foreach ($person->commandShips as $ship) : ?>
                        <div><?php echo $ship; ?></div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="backRight">
                <div class="address"><?php echo $person->getAddress(); ?></div>
                <div class="contact">
                    <ul>
                        <li class="phone"><?php echo $person->phone; ?></li>
                        <li class="email"><?php echo $person->email; ?></li>
                        <li class="web"><?php echo $person->webURL; ?></li>
                    </ul>
                </div>
                <div class="available"><?php echo $person->getJobStatus(); ?> looking for work.</div>
            </div>
        </div>
    </div>
<?php endforeach; ?>