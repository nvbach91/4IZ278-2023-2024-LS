<?php 

$people = [];

$person1 = new Person("Vilém", "Charwot", new DateTime("6/12/2002"),
    "Software Developer", "Charwot, s.r.o.", 
    new Address("Monkey Business", 120, 90, "Gorilla Town"),
    "+420 777 555 555", "chav07@vse.cz", "eso.vse.cz/~chav07/portfolio/", true,
    "./images/vizitka-logo.svg");

$person2 = new Person("John", "Doe", new DateTime("10/5/1983"),
    "Accountant", "Accounting4U, ltd.", new Address("Moskevská",
    2000, 12, "Prague"), "+420 761 225 888", "john.doe@example.com", "john-doe.com", true,
    "https://siderite.dev/Posts/files/placeholder.com-logo1_637146769278368505.jpg");

$person3 = new Person(
    "Marie",
    "Terezie",
    new DateTime("6/12/2002"),
    "Queen",
    "Empire",
    new Address("Kings road",10,10, "Vienna"),
    "777 777 777",
    "marie.terezie@empire.au",
    "marie@empire.au",
    false,
    "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ftse4.mm.bing.net%2Fth%3Fid%3DOIP.S4YAyobfRRCDh_DdBx9BAAHaDb%26pid%3DApi&f=1&ipt=4885355f432f0782574d196af7eb6acf7e4c0521e3abbefe2c06491ecfbe84e8&ipo=images"
);

array_push($people,$person1);
array_push($people, $person2);
array_push($people, $person3);
?>


<main class="main-wrapper">
    <h1 >Business Cards</h1>
    <?php foreach ($people as $person): ?>
        <?php echo createPersonCard($person); ?>
    <?php endforeach; ?>
    <br>
</main>