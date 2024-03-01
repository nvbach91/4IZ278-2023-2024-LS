<?php 
require './classes/Person.php';

$Tim = new Person (
    'apple.png',
    'Tim',
    'Cook',
    '1960-11-01',
    'Apple',
    'Chief Executive Officer',
    '1', 
    'Apple Park Way',
     'Cupertino',
    '1-(833)-317-1755',
    't.cook@apple.com',
    'apple.com',
    false,
);

$Satya = new Person (
    'microsoft.png',
    'Satya',
    'Nadella',
    '1967-08-19',
    'Microsoft',
    'Chief Executive Officer',
    '1', 
    'A Microsoft Way',
     'WA',
    '1-(833)-327-1755',
    's.nadella@microsoft.com',
    'microsoft.com',
    false,
);

$Sundar = new Person (
    'google.png',
    'Sundar',
    'Pichai',
    '1972-06-10',
    'Google',
    'Chief Executive Officer',
    '1900', 
    'Amphitheatre Parkway',
     'MW',
    '1-(833)-337-1755',
    's.pichai@google.com',
    'google.com',
    false,
);

$people = [];
array_push($people, $Tim);
array_push($people, $Satya);
array_push($people, $Sundar);



?>


        <?php foreach($people as $person): ?>
        <div class="container">    
            <div class="business-card">
                <div class="column">
                    <div class= "logo" style="background-image: url(./img/<?php echo $person -> avatar; ?>)"></div>
                </div>
                <div class="column2">
                    <div class="first-name"><?php echo $person -> firstName; ?></div>
                    <div class="last-name"><?php echo $person -> lastName; ?></div>
                    <div class="position"><?php echo $person -> position; ?></div>
                    <div class="company"><?php echo $person -> company; ?></div>
                </div>
            
            </div>

            <div class="business-card">
                <div class="column2">
                <div class="first-name"><?php echo $person -> firstName; ?></div>
                    <div class="last-name"><?php echo $person -> lastName; ?></div>
                    <div class="company2"><?php echo $person -> company; ?></div>
                    <div class="position2"><?php echo $person -> position; ?></div>
                </div>
                <div class="column2 border">
                    <div class="info">Age: <?php echo $person -> getAge(); ?></div>
                    <div class="info">Address: <?php echo $person -> getAddress(); ?></div>
                    <div class="info">Phone: <?php echo $person -> phone; ?></div>
                    <div class="info">Email: <?php echo $person -> email; ?></div>
                    <div class="info">Website: <?php echo $person -> web; ?></div>
                    <div class="info"><?php echo $person -> getNewContracts(); ?></div>
                </div>
            
            </div>
        </div>

        <?php endforeach; ?>
     



    
