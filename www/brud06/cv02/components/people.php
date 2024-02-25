<?php
require './classes/Person.php';

$person1 = new Person(
    "./images/Bulbasaur.jpg",
    "Daniel",
    "Brus",
    1980,
    "Engineer",
    "Nikoly Vapcarova",
    "Praha",
    "123-456-7890",
    "brud06@vse.cz",
    "www.eso.vse.cz",
    false,
    "Vse Corp",
    "14300"
);

$person2 = new Person(
    "./images/Charmander.png",
    "Charmander",
    "Pokemon",
    1985,
    "Doctor",
    "456 Elm St",
    "Los Angeles",
    "987-654-3210",
    "charmander@example.com",
    "www.pokemon.com",
    true,
    "XYZ Corp",
    "90001"
);

$person3 = new Person(
    "./images/Dialga.jpg",
    "Dialga",
    "Pokemon",
    1990,
    "Artist",
    "789 Oak St",
    "Chicago",
    "456-789-1230",
    "dialga.pokemon@example.com",
    "www.dialga.com",
    false,
    "DEF Corp",
    "60007"
);
$people = [];
array_push($people, $person1);
array_push($people, $person2);
array_push($people, $person3);
?>
<?php foreach ($people as $person) : ?>
    <div class="business-card">
        <div class="business-card-front">
            <div class="company-logo">
                <img src="<?php echo $person->avatar; ?>" alt="company-logo">
            </div>
            <div class="full-name"><?php echo $person->getFullName(); ?></div>
            <div class="age"><?php echo $person->getAge(); ?></div>
            <div class="profession"><?php echo $person->profession; ?></div>
        </div>
        <div class="business-card-back">
            <div class="company-name"><?php echo $person->companyName; ?></div>
            <div class="adress"><?php echo $person->getAdress(); ?></div>
            <div class="phoneNumber"><?php echo $person->phoneNumber; ?></div>
            <div class="email"><?php echo $person->email; ?></div>
            <div class="website"><?php echo $person->website; ?></div>
            <div class="isLookingForJob">Looking for job?: <?php echo $person->isLookingForJob ? 'Yes' : 'No'; ?></div>
        </div>
    </div>
<?php endforeach; ?>