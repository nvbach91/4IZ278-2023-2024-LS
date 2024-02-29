<?php

require './classes/Person.php';
require './utils/utils.php';

$people = [];

array_push($people, new Person(
    "1999-06-06",
    "./images/maleBase.png",
    "EvilCorp.",
    "dontEmailMe@doit.com",
    false,
    "Tomas",
    "Random Position",
    "Chair St.",
    25,
    1456,
    "Ibl",
    "+420666666666",
    "Awesome Town",
    "someWebsite.com",
));

array_push($people, new Person(
    "1995-05-05",
    "./images/maleBase.png",
    "Be Productive Inc.",
    "m.henderson@dontmail.com",
    true,
    "Max",
    "Journalist",
    "Evil Ave.",
    52,
    7091,
    "Henderson",
    "776-4123-05",
    "Goodville",
    "HendersonDaBest.com",
));

array_push($people, new Person(
    "1987-02-02",
    "./images/femaleBase.png",
    "Be Productive Inc.",
    "a.carroll@dontmail.com",
    true,
    "Adelaide",
    "Architect",
    "Baker St.",
    65,
    712,
    "Carroll",
    "371-6637-07",
    "Spingfield",
    "coolstuffhere.com",
));

array_push($people, new Person(
    "2004-08-10",
    "./images/maleBase.png",
    "Be Productive Inc.",
    "k.alexander@dontmaoil.com",
    false,
    "Kelvin",
    "Dancer",
    "Evil Ave.",
    3,
    70,
    "Alexander",
    "459-7062-81",
    "Westworld",
    "danceitoff.com",
));

array_push($people, new Person(
    "1995-01-01",
    "./images/maleBase.png",
    "Be Productive Inc.",
    "a.morris@dontmail.com",
    false,
    "Adison",
    "Interior Designer",
    "Honey St.",
    30,
    1057,
    "Morris",
    "808-8064-86",
    "Lazy Town",
    "designme.com",
));

array_push($people, new Person(
    "1990-10-10",
    "./images/femaleBase.png",
    "Be Productive Inc.",
    "clareisnice@gmail.com",
    true,
    "Clare",
    "Gardener",
    "Great St.",
    11,
    127,
    "Smith",
    "580-0944-72",
    "Brighton",
    "clareiscool.com",
));
?>

<?php foreach ($people as $person) : ?>
    <div class="cards-container">
        <div class="card-left">
            <div class="bc-header">
                <?php echo $person->getFullName(); ?>
            </div>
            <div class="bc-content">
                <div class="bc-content-side">
                    <ul>
                        <li>
                            <?php echo $person->position; ?>
                        </li>
                        <li>
                            <?php echo $person->company; ?>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <?php echo $person->town; ?>
                        </li>
                        <li>
                            <?php echo $person->street; ?>
                        </li>
                        <li>
                            <?php echo $person->getStreetNumber(); ?>
                        </li>
                    </ul>
                </div>
                <div class="bc-content-deco"></div>
                <div class="bc-content-side">
                    <ul class="last-item-shifted">
                        <li>
                            Age: <?php getAge($person->dob); ?>
                        </li>
                        <li>
                            <img src="<?php echo $person->avatar; ?>" alt="<?php echo $person->getFullName() . ' avatar' ?>">
                        </li>
                    </ul>
                </div>
            </div>
            <div class="bc-footer">
                <ul>
                    <li>
                        <a href="tel:<?php echo $person->tel; ?>">
                            <i class='fas fa-phone'></i>
                            <?php echo $person->tel; ?>
                        </a>
                    </li>
                    <li>
                        <a href="mailto:<?php echo $person->email; ?>">
                            <i class='fas fa-envelope'></i>
                            <?php echo $person->email; ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-right">
            <div class="bc-front-header">
                <div>
                    <?php echo $person->getFullName(); ?>
                </div>
            </div>
            <div class="bc-front-middle">
                <div class="bc-front-deco-side"></div>
                <div class="bc-front-deco-left">
                    <div class="bc-front-deco-extra"></div>
                    <div class="bc-front-deco-extra-mid"></div>
                    <div class="bc-front-deco-extra"></div>
                </div>
                <div class="bc-front-deco-mid"></div>
                <div class="bc-front-deco-right">
                    <div class="bc-front-deco-extra"></div>
                    <div class="bc-front-deco-extra-mid"></div>
                    <div class="bc-front-deco-extra"></div>
                </div>
                <div class="bc-front-deco-side"></div>
            </div>
            <div class="bc-front-footer">
                <a href="https://www<?php echo $person->webPage; ?>/"><?php echo $person->webPage; ?></a>
                <a href="mailto:<?php echo $person->email; ?>"><?php echo $person->getAvailability(); ?></a>
            </div>
        </div>
    </div>
<?php endforeach; ?>