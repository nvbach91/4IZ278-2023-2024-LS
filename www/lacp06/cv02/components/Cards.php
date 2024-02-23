<?php
include "./classes/Person.php";

$joe = new Person(
  "Joe",
  "Average",
  "2004-03-10",
  "Accounting",
  "Chanel",
  "Nad Pelikánem",
  133,
  56,
  "Prague",
  "+420 606 566 789",
  "joe.average@gmail.com",
  "https://www.chanel.com/",
  true
);
$john = new Person(
  "John",
  "Peterson",
  "2001-01-12",
  "Management",
  "Chanel",
  "Nad Vorlem",
  121,
  58,
  "Brno",
  "+420 777 546 769",
  "john.peterson@gmail.com",
  "https://www.chanel.com/",
  false
);
$rick = new Person(
  "Rick",
  "Grimes",
  "1975-02-25",
  "Designer",
  "Chanel",
  "Nad Špejlí",
  344,
  90,
  "Atlanta",
  "+420 878 344 223",
  "rick.grimes@gmail.com",
  "https://www.chanel.com/",
  true
);

$persons = [$joe, $john, $rick];

?>
<main class="container">
  <?php foreach ($persons as $person) : ?>
    <div class="main-card">
      <div class="card2">
        <img class="logo" src="https://www.logo.wine/a/logo/Chanel/Chanel-Logo.wine.svg">
      </div>
      <div class="card">
        <div class="name">
          <p class="first-name"><?php echo $person->getFullName(); ?></p>
        </div>
        <div class="info">
          <img src="./img/user.svg" />
          <p class="age"><?php echo $person->getAge(); ?></p>
        </div>
        <div class="info">
          <img src="./img/briefcase.svg" />
          <p class="job"><?php echo $person->isLookingForJob ? "Looking for job" : "Employed"; ?></p>
        </div>
        <div class="info">
          <img src="./img/building.svg" />
          <p class="company-name"><?php echo $person->companyName; ?></p>
        </div>
        <div class="info">
          <img src="./img/map.svg" />
          <p class="adress"><?php echo $person->getAdress(); ?></p>
        </div>
        <div class="info">
          <img src="./img/home.svg" />
          <p class="city"><?php echo $person->city; ?></p>
        </div>
        <div class="info">
          <img src="./img/phone.svg" />
          <p class="phone"><?php echo $person->phone; ?></p>
        </div>
        <div class="info">
          <img src="./img/mail.svg" />
          <p class="email"><?php echo $person->email; ?></p>
        </div>
        <div class="info">
          <img src="./img/portfolio.svg" />
          <p class="porfolio"><a href="<?php echo $person->portfolio; ?>" target="_blank"><?php echo $person->portfolio; ?></a></p>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</main>