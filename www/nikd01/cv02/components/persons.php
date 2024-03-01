<?php

require './classes/Person.php';

$persons = [];

$person1 = new Person(
    'person1.png',
    'John',
    'Doe',
    'Mr.',
    'Company A',
    '123-456-7890',
    'john.doe@example.com',
    'https://johndoe.com',
    true,
    'Main Street',
    '123',
    '1',
    'Springfield',
    1000.50,
    'USD'
);

$person2 = new Person(
    'person2.png',
    'Jane',
    'Smith',
    'Ms.',
    'Company B',
    '987-654-3210',
    'jane.smith@example.com',
    'https://janesmith.com',
    false,
    'Second Street',
    '456',
    '2',
    'Shelbyville',
    2000.75,
    'EUR'
);

$person3 = new Person(
    'person3.png',
    'Alice',
    'Johnson',
    'Dr.',
    'Company C',
    '111-222-3333',
    'alice.johnson@example.com',
    'https://alicejohnson.com',
    true,
    'Third Street',
    '789',
    '3',
    'Ogdenville',
    3000.00,
    'GBP'
);

$person4 = new Person(
    'person4.png',
    'Bob',
    'Brown',
    'Prof.',
    'Company D',
    '444-555-6666',
    'bob.brown@example.com',
    'https://bobbrown.com',
    false,
    'Fourth Street',
    '101',
    '4',
    'North Haverbrook',
    4000.25,
    'JPY'
);

$persons[] = $person1;
$persons[] = $person2;
$persons[] = $person3;
$persons[] = $person4;
?>

<ul>
    <?php foreach ($persons as $person): ?>
        <li>
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
                    <div class="bc-address"><i class="fas fa-map-marker-alt"></i> <?php echo $person->getAddress(); ?>
                    </div>
                    <div class="bc-phone"><i class="fas fa-phone"></i> <?php echo $person->phone; ?></div>
                    <div class="bc-email"><i class="fas fa-at"></i> <?php echo $person->email; ?></div>
                    <div class="bc-website"><i class="fas fa-globe"></i> <?php echo $person->website; ?></div>
                    <div class="bc-available"><?php echo $person->getAvailability() ?></div>
                    <div class="bc-bank-balance"><i
                                class="fas fa-money-bill-wave"></i> <?php echo $person->getBankBalance(); ?></div>
                </div>
            </div>
        </li>
    <?php endforeach; ?>
</ul>


