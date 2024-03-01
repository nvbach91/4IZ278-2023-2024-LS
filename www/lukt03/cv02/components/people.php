<?php

require './classes/person.php';

$terka = new Person(
    'https://eso.vse.cz/~lukt03/cv02/img/avatar.png',
    'Terka', 'Lukešová',
    new DateTime('1997-10-06'),
    'Student',
    'Prague University of Economics and Business',
    'nám. W. Churchilla', 1938, 4, 'Prague',
    '+420 123 456 789',
    'lukt03@vse.cz',
    'eso.vse.cz/~lukt03',
    false
);

$tomas = new Person(
    'https://eso.vse.cz/~lukt03/cv02/img/vaporeon.png',
    'Tomáš', 'Jedno',
    new DateTime('1970-01-01'),
    'Associate Professor',
    'Prague University of Economics and Business',
    'Ekonomická', 957, null, 'Prague',
    '+420 123 456 789',
    'tomas.jedno@vse.cz',
    'eso.vse.cz/~tjedno',
    true
);

$bulbasaur = new Person(
    'https://eso.vse.cz/~lukt03/cv02/img/bulbasaur.png',
    'Bulbasaur', 'Pokémonový',
    new DateTime('1996-02-27'),
    'Grass Pokémon',
    'Pokémon University',
    'Nintendo st.', 1, null, 'Pallet Town',
    'N/A',
    'bulbasaur@pokemon.com',
    'pokemon.com',
    false
);

$people = [$terka, $tomas, $bulbasaur];

?>

<h1>My Business Cards</h1>
<?php foreach ($people as $person): ?>
<div class="business-card">
    <div class="business-card-side">
        <div class="avatar">
            <img
                src="<?php echo $person->avatar; ?>"
                alt="<?php echo $person->getFullName(); ?>"
            >
        </div>
        <div class="first-name"><?php echo $person->firstName; ?></div>
        <div class="last-name"><?php echo $person->lastName; ?></div>
        <div class="age">Age: <?php echo $person->getAge(); ?></div>
        <div class="job"><?php echo $person->job; ?></div>
        <div class="company"><?php echo $person->company; ?></div>
    </div>
    <div class="business-card-side">
        <h2>Where can you find me?</h2>
        <div class="address">&#x1F4EC; <?php echo $person->getAddress(); ?></div>
        <div class="phone">&#x1F4DE; <?php echo $person->phone; ?></div>
        <div class="email">&#x1F4E8; <?php echo $person->email; ?></div>
        <div class="website">&#x1F310; <a href="<?php echo $person->getWebsiteUrl(); ?>"><?php echo $person->website; ?></a></div>
        <div class="lookingForJob">&#x1F4BC; <?php echo $person->getLookingForJobText(); ?></div>
    </div>
</div>
<?php endforeach; ?>