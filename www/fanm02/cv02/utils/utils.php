
<?php
require './classes/Person.php';

function generatePeople() {
    $vader = new Person(
        'Darth',
        'Vader',
        '1977-05-25',
        'sithlord',
        'Galactic Empire Co.',
        'Mustafar',
        '1',
        '1',
        'Sky city',
        '123-456-7890',
        'vader@empire.gl',
        'darthvader.com/aboutme',
        'https://i.ebayimg.com/images/g/mR0AAOSwImRYJjtI/s-l1200.jpg',
        true
    );
    
    $yoda = new Person(
        'Yoda',
        'Master',
        '1977-05-25',
        'jedi',
        'Resistance Co.',
        'Dagobah',
        '1',
        '1',
        'Sky city',
        '123-456-7890',
        'yoda@resistance.gl',
        'yoda.com/aboutme',
        'https://cdn.wallpapersafari.com/91/83/67Iiez.jpg',
        true
    );
    
    $c3po = new Person(
        'C3-PO',
        '',
        '1977-05-25',
        'droid',
        'Resistance Co.',
        'Tatooine',
        '1',
        '1',
        'Mos Espa',
        '123-456-7890',
        'c3po@resistance.gl',
        'c3.po/aboutme',
        'https://i.pinimg.com/originals/3c/ac/f8/3cacf8b2a90a2943ac3700b0bc94dae1.jpg',
        true
    );
    
    $people = [];
    array_push($people, $vader);
    array_push($people, $yoda);
    array_push($people, $c3po);

    return $people;
  }

?>