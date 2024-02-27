<?php
require "./classes/Person.php";
require "./utils/utils.php";

$address = array(
    "name" => "Ernst & Young",
    "street" => "Na Florenci",
    "houseNumber1" => 2116,
    "houseNumber2" => 15,
    "city" => "Praha"
);

$person1 = new Person(
    "Boxan",
    "David",
    "student, data scientist",
    array(
        "name" => "Ernst & Young",
        "street" => "Na Florenci",
        "houseNumber1" => 2116,
        "houseNumber2" => 15,
        "city" => "Praha"
    ),
    array(
        "phone" => "+420 705 844 114",
        "email" => "david.boxan@cz.ey.com",
        "web" => "https://github.com/boxandav"
    ),
    false,
    "2001-07-17"
);

$person2 = new Person(
    "Testovací",
    "Zaměstnanec",
    "employee",
    $address,
    array(
        "phone" => "+420 777 777 777",
        "email" => "test.zam@cz.ey.com",
        "web" => "https://vse.cz"
    ),
    true,
    "1970-01-01"
);

$person3 = new Person(
    "Vánoční",
    "Ježíšek",
    "holiday character",
    $address,
    array(
        "phone" => "+420 123 123 123",
        "email" => "jezisek.vanocni@cz.ey.com",
        "web" => "https://vanoce.vira.cz"
    ),
    false,
    "0001-12-24"
);

$people = [];
array_push($people, $person1);
array_push($people, $person2);
array_push($people, $person3);

$bodyBackground = "https://virtualbackgrounds.site/wp-content/uploads/2020/07/windows-xp-wallpaper-bliss.jpg";
$cardBackground = "https://image.slidesdocs.com/responsive-images/background/business-card-line-texture-white-fresh-business-card-powerpoint-background_8485d73f09__960_540.jpg";
$logoLink = "https://upload.wikimedia.org/wikipedia/commons/3/34/EY_logo_2019.svg";
?>

<?php foreach($people as $person): ?>
<div id="business-card" style="background-image: url('<?php echo $cardBackground; ?>')">
    <div class="column">
        <img src="<?php echo $logoLink; ?>"/>
        <p style="font-size: 1.5rem"><b><?php echo getFullName($person); ?></b> <em><?php echo getAge($person); ?></em></p>
        <p><b><?php echo $person->occupation; ?></b></p>
        <p><?php if (!$person->lookingForWork): ?>not <?php endif; ?>looking for work</p>
    </div>
    <div class="column" style="margin-left: 1.5rem">
        <p><?php echo $person->company["name"] ?></p>
        <p><?php echo getAddress($person); ?></p>
        <hr/>
        <p><?php echo $person->contact["phone"] ?></p>
        <p><?php echo $person->contact["email"] ?></p>
        <p><a href="<?php echo $person->contact['web']; ?>">Visit web</a></p>
    </div>
</div>
<br/>
<?php endforeach; ?>
