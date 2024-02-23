<?php

require_once './classes/Person.php';

$yoda = new Person(
  "yoda-avatar.png",
  "yoda.png",
  "Yoda",
  "Master",
  "1183-01-01",
  "Jedi Master",
  "Jedi Order",
  "Super Swamp",
  "863",
  "4",
  "Dagobah",
  "123-456-7890",
  "master.yoda@jediorder.com",
  "https://jediorder.com",
  false,
  [
    'primary' => "123456789/1234",
    'secondary' => "987654321/4321"
  ]
);

$anakin = new Person(
  "anakin-avatar.png",
  "anakin.png",
  "Anakin",
  "Skywalker",
  "1994-01-01",
  "Guy Who Likes Children (not in a weird way)",
  "Jedi Order",
  "Tatooine",
  "123",
  "4",
  "Coruscant",
  "123-456-7890",
  "notamaster.anakin@jediorder.com",
  "https://jediorder.com",
  true,
  [
    'primary' => "123456789/1234",
    'secondary' => "987654321/4321"
  ]
);

$obiwan = new Person(
  "obiwan-avatar.png",
  "obiwan.png",
  "Obi-Wan",
  "Kenobi",
  "1983-01-01",
  "Jedi Master",
  "Jedi Order",
  "Stewjon",
  "123",
  "4",
  "Coruscant",
  "123-456-7890",
  "obi-wan.kenobi@jediorder.com",
  "https://jediorder.com",
  false,
  [
    'primary' => "123456789/1234",
    'secondary' => "987654321/4321"
  ]
);

$persons = [$yoda, $anakin, $obiwan];

?>

<?php foreach ($persons as $person) : ?>

  <div class="relative w-fit m-6 group">
    <div class="bg-green p-6 rounded-xl w-fit flex row gap-8 text-white z-10 relative">
      <div class="flex flex-col">
        <div class="flex items-center space-x-4">
          <img class="h-16 w-16 rounded-full" src="assets/<?php echo $person->getAvatar(); ?>" alt="Avatar">
          <div>
            <h2 class="text-xl font-bold"><?php echo $person->getFullName(); ?></h2>
            <p class="text-xs uppercase"><?php echo $person->getFullJob(); ?></p>
          </div>
        </div>
        <div class="mt-auto mb-0">
          <p class="flex items-center gap-3">
            <?php include './includes/assets/map.php' ?>
            <?php echo $person->getAddress(); ?>
          </p>
          <a href="tel:<?php echo $person->getPhone(); ?>" class="transition-all hover:underline">
            <p class="mt-2 flex items-center gap-3">
              <?php include './includes/assets/phone.php' ?>
              <?php echo $person->getPhone(); ?>
            </p>
          </a>
          <a href="mailto:<?php echo $person->getEmail(); ?>" class="transition-all hover:underline">
            <p class="mt-2 flex items-center gap-3">
              <?php include './includes/assets/mail.php' ?>
              <?php echo $person->getEmail(); ?>
            </p>
          </a>
          <a href="<?php echo $person->getWeb(); ?>" target="_blank" class="transition-all hover:underline">
            <p class="mt-2 flex items-center gap-3">
              <?php include './includes/assets/globe.php' ?>
              <?php echo $person->getWeb(); ?>
            </p>
          </a>
        </div>
      </div>
      <div class="bg-white w-0.5"></div>
      <div class="mb-0 mt-auto">
        <p class="mt-4 flex items-center gap-3">
          <?php echo $person->getFullAge() ?>
        </p>
        <p class="mt-2"><?php echo $person->getJobStatus(); ?></p>
        <p class="mt-2 text-[0.5rem] uppercase">Account Numbers (send money pls):</p>
        <?php foreach ($person->getAccountNumbers() as $key => $value) : ?>
          <div class="mt-1 mb-2 last-of-type:mb-0 bg-white p-2 rounded-md text-green">
            <p class="text-xs uppercase rounded-sm border-[1px] border-green pl-1 pr-1 w-fit"><?php echo $key; ?></p>
            <?php echo $value; ?>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <img alt="yoda" src="assets/<?php echo $person->getScareCrow() ?>" class="absolute top-0 translate-y-1/2 right-0 z-0 h-1/2 transition-all translate-x-0 delay-500 group-hover:delay-1000 group-hover:translate-x-full" />
  </div>

<?php endforeach; ?>