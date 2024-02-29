<?php
require './classes/Person.php';

$geralt = new Person(
    'logo.png',
    'cardTemplateFront.jpg',
    'cardTemplateBack.jpg',
    'Geralt', 
    'of',
    'Rivia',
    'White Wolf',
    'Witcher',
    'School of the wolf',
    "The Witcher's Keep",
    42,
    42024,
    'Kaer Morhen',
    'white.wolf@kaermorhen.com', 
    '+420 777 888 999', 
    true, 
    1174, 
    1272
);
$vesemir = new Person(
    'logo.png',
    'cardTemplateFront.jpg',
    'cardTemplateBack.jpg',
    'Vesemir', 
    'of',
    'Kaer Morhen',
    'Old Wolf',
    'Witcher',
    'School of the wolf',
    "The Witcher's Keep",
    16,
    42024,
    'Kaer Morhen',
    'old.wolf@kaermorhen.com', 
    '+420 777 888 555', 
    false, 
    1095, 
    1272
);
$eskel = new Person(
    'logo.png',
    'cardTemplateFront.jpg',
    'cardTemplateBack.jpg',
    'Eskel', 
    'of',
    'Kaer Morhen',
    'Scarred Wolf',
    'Witcher',
    'School of the wolf',
    "The Witcher's Keep",
    99,
    42024,
    'Kaer Morhen',
    'scarred.wolf@kaermorhen.com', 
    '+420 777 888 111', 
    false, 
    1175, 
    1272
);
$persons = [];
array_push($persons, $geralt);
array_push($persons, $vesemir);
array_push($persons, $eskel);
?>
<?php foreach($persons as $person): ?>
    <div class="container">
        <div class="card" style="background-image: url(./img/<?php echo $person->cardTemplateFront; ?>)">
            <div class="avatar">
                <div class="avatar-pic" style="background-image: url(./img/<?php echo $person->avatar; ?>)"></div>
            </div>
            <div class="front-info">
                <div class="front-info-content">
                    <div class="front-name"><?php echo $person->getFullName(); ?></div>
                    <div class="alias"><?php echo $person->alias; ?></div>
                    <div class="title"><?php echo $person->title; ?></div>
                    <div class="bc-company"><?php echo $person->company; ?></div>
                </div>
            </div>
        </div>
        <div class="card" style="background-image: url(./img/<?php echo $person->cardTemplateBack; ?>)">
            <div class="back-left">
                <div class="back-left-content">
                    <div class="back-name"><?php echo $person->getFullName(); ?></div>
                    <div class="age"><?php echo $person->getAge() . " y/o"; ?></div>
                    <div class="title"><?php echo $person->title; ?></div>
                </div>
            </div>
            <div class="back-right">
                <div class="back-right-content">
                    <div class="address"><?php echo $person->getAddress(); ?></div>
                    <div class="phone"><?php echo "$person->phone"; ?></div>
                    <div class="email"><?php echo "$person->email"; ?></div>
                    <div class="available"><?php echo $person->available ? 'Available for contracts' : 'Not available for contracts'; ?></div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
