<?php
require './classes/Person.php';
require './components/utils.php';

$homer = new Person(
    'Homer',
    'Simpson',
    '42',
    true,
    'nuclear safety inspector',
    'Springfield Nuclear Power Plant',
    'Industrial Way',
    '100',
    '7G',
    'Springfield',
    '+420 777 888 999',
    'NPP@springfield.com',
    'springfieldNPP.com',
    false,
    './img/homer/logo.png',
    './img/homer/logo-back.png',
    './img/homer/background.jpeg'
);

$moe = new Person(
    'Moe',
    'Szyslak',
    '41',
    false,
    'barkeeper',
    'Moe\'s Tavern',
    'Walnut Street',
    '38',
    '2B',
    'Springfield',
    '+420 777 888 999',
    'MOES@springfield.com',
    'moestavern.com',
    false,
    './img/moe/logo.png',
    './img/moe/logo-back.png',
    './img/moe/background.jpg'
);

$skinner = new Person(
    'Principal',
    'Skinner',
    '57',
    true,
    'principal',
    'Springfield School',
    'University Street',
    '12',
    '9F',
    'Springfield',
    '+420 777 888 999',
    'principal@school.com',
    'springfieldschool.com',
    false,
    './img/skinner/logo.png',
    './img/skinner/logo-back.png',
    './img/skinner/background.jpg'
);

$businessCards = [];
array_push($businessCards, $homer);
array_push($businessCards, $moe);
array_push($businessCards, $skinner);
?>

<h1>Business Cards</h1>
<div class="showcase">
    <a>Result of age calculating function: <?php echo getAgeFromDate("1996-2-1"); ?><br></a>
    <a>Result of getAdress() class function: <?php echo $homer->getAddress(); ?><br></a>
    <a>Result of getFullName() class function: <?php echo $moe->getFullName(); ?><br></a>
    <a>Result of getAge() class function: <?php echo $skinner->getAge(); ?><br></a>
</div>

<?php foreach ($businessCards as $businessCard) : ?>
    <div class="business-card" style="background-image: url(<?php echo $businessCard->businessCardBackgroudImageUrl ?>)">
        <div class="row">
            <div class="left">
                <img class="logo" alt=<?php echo $businessCard->name; ?> src=<?php echo $businessCard->logo ?>>
            </div>
            <div class="right">
                <div class="first-name"><?php echo $businessCard->name; ?></div>
                <div class="last-name"><?php echo $businessCard->lastName; ?></div>
                <div class="age"> Age: <?php echo $businessCard->age; ?></div>
                <div class="is-married"> Status: <?php if ($businessCard->isMarried) {
                                                        echo 'Married';
                                                    } else echo 'Single' ?></div>
            </div>
        </div>
    </div>

    <div class="business-card" style="background-image: url(<?php echo $businessCard->businessCardBackgroudImageUrl ?>)">
        <div class="row">
            <div class="left-back">
                <div class="default-text"> Street: <?php echo $businessCard->street; ?></div>
                <div class="default-text"> Street number: <?php echo $businessCard->streetCode; ?></div>
                <div class="default-text"> Sector: <?php echo $businessCard->sector; ?></div>
                <div class="default-text"> City: <?php echo $businessCard->city; ?></div>
                <div class="default-text"> Telephone: <?php echo $businessCard->number; ?></div>
                <div class="default-text"> Email: <?php echo $businessCard->email; ?></div>
                <div class="default-text"> Website: <?php echo $businessCard->website; ?></div>
                <div class="default-text"> Looking for job: <?php if ($businessCard->lookingForJob) {
                                                                echo 'Yes';
                                                            } else echo 'No' ?></div>
            </div>
            <div class="right-back">
                <img class="logo-back" alt=<?php echo $businessCard->name; ?> src=<?php echo $businessCard->logoBack ?>>
            </div>
        </div>
    </div>
<?php endforeach; ?>