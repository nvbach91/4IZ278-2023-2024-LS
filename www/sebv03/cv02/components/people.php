<?php
require './classes/Person.php';
$person = new Person(
    "Taylor",
    "Otwell",
    "1984-12-22",
    "Founder, CEO, Lambo guy",
    "Laravel",
    "Pebble Beach Dr",
    4908,
    7744,
    "Benton",
    "777 777 777",
    "otwell@laravel.com",
    "https://laravel.com/",
    false,
    "https://i2.wp.com/files.123freevectors.com/wp-content/original/205164-neon-green-wave-business-card-background-graphic.jpg?w=500&q=95",
    "https://avatars.githubusercontent.com/u/463230?v=4"
);
$person2 = new Person(
    "Mario",
    "Me!",
    "2004-13-02",
    "Just Mario",
    "Nowhere",
    "Italy",
    123,
    4569,
    "Italian city",
    "666 666 666",
    "mail@mario.it",
    "mario.com",
    true,
    "https://i2.wp.com/files.123freevectors.com/wp-content/original/205164-neon-green-wave-business-card-background-graphic.jpg?w=500&q=95",
    "https://mario.nintendo.com/static/fd723b2893d4d2b39ef71bfdb4e3329c/a722b/mario-background.png"

);
$person3 = new Person(
    "Jane",
    "Doe",
    "1932-11-02",
    "Youtuber",
    "Youtube",
    "Somewhere",
    420,
    9696,
    "Los Angeles",
    "666 666 666",
    "jane@doe.com",
    "https://youtube.com/",
    true,
    "https://img.freepik.com/free-vector/elegant-red-background_1340-4770.jpg?size=338&ext=jpg&ga=GA1.1.1827530304.1709769600&semt=ais",
    "https://www.fbi.gov/wanted/vicap/unidentified-persons/john-doe-21/@@images/image/large"

);
$people = [];
array_push($people, $person, $person2, $person3);
?>