<?php

$avatar = "yoda-avatar.png";
$lastName = "Yoda";
$firstName = "Master";
$birthDate = "1183-01-01";
$job = "Jedi Master";
$company = "Jedi Order";
$street = "Super Swamp";
$houseNumber = "863";
$orientationNumber = "4";
$city = "Dagobah";
$phone = "123-456-7890";
$email = "master.yoda@jediorder.com";
$web = "https://jediorder.com";
$lookingForJob = false;
$accountNumbers = [
  'primary' => "123456789/1234",
  'secondary' => "987654321/4321"
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vizitka</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        fontFamily: {
          'sans': ['IBM Plex Sans', 'sans-serif'],
        },
        extend: {
          colors: {
            'white': '#fff',
            'green': '#7B886F'
          }
        }
      }
    }
  </script>
</head>

<body>

  <?php
  $address = $street . " " . $houseNumber . "/" . $orientationNumber . ", " . $city;
  ?>

  <div class="relative w-fit m-6 group">
    <div class="bg-green p-6 rounded-xl w-fit flex row gap-8 text-white z-10 relative">
      <div class="flex flex-col">
        <div class="flex items-center space-x-4">
          <img class="h-16 w-16 rounded-full" src="<?php echo $avatar; ?>" alt="Avatar">
          <div>
            <h2 class="text-xl font-bold"><?php echo $firstName . ' ' . $lastName; ?></h2>
            <p class="text-xs uppercase"><?php echo $job . ' at ' . $company; ?></p>
          </div>
        </div>
        <div class="mt-auto mb-0">
          <p class="flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map">
              <polygon points="3 6 9 3 15 6 21 3 21 18 15 21 9 18 3 21" />
              <line x1="9" x2="9" y1="3" y2="18" />
              <line x1="15" x2="15" y1="6" y2="21" />
            </svg>
            <?php echo $address; ?>
          </p>
          <a href="tel:<?php echo $phone; ?>" class="transition-all hover:underline">
            <p class="mt-2 flex items-center gap-3">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
              </svg>
              <?php echo $phone; ?>
            </p>
          </a>
          <a href="mailto:<?php echo $email; ?>" class="transition-all hover:underline">
            <p class="mt-2 flex items-center gap-3">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-at-sign">
                <circle cx="12" cy="12" r="4" />
                <path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-4 8" />
              </svg>
              <?php echo $email; ?>
            </p>
          </a>
          <a href="<?php echo $web; ?>" target="_blank" class="transition-all hover:underline">
            <p class="mt-2 flex items-center gap-3">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-globe">
                <circle cx="12" cy="12" r="10" />
                <path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20" />
                <path d="M2 12h20" />
              </svg>
              <?php echo $web; ?>
            </p>
          </a>
        </div>
      </div>
      <div class="bg-white w-0.5"></div>
      <div class="mb-0 mt-auto">
        <p class="mt-4 flex items-center gap-3">
          <?php
          $birthDate = new DateTime($birthDate);
          $now = new DateTime();

          $interval = $now->diff($birthDate);

          echo "I am " . $interval->format('%y') . " years old (damn).";
          ?>
        </p>
        <p class="mt-2"><?php echo $lookingForJob ? 'Currently looking for a job' : 'Unfortunately not looking for a job!'; ?></p>
        <p class="mt-2 text-[0.5rem] uppercase">Account Numbers (send money pls):</p>
        <?php foreach ($accountNumbers as $key => $value) : ?>
          <div class="mt-1 mb-2 last-of-type:mb-0 bg-white p-2 rounded-md text-green">
            <p class="text-xs uppercase rounded-sm border-[1px] border-green pl-1 pr-1 w-fit"><?php echo $key; ?></p>
            <?php echo $value; ?>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <img alt="yoda" src="yoda.png" class="absolute top-0 translate-y-1/2 right-0 z-0 h-1/2 transition-all translate-x-0 delay-500 group-hover:delay-1000 group-hover:translate-x-full" />
  </div>

</body>

</html>