<?php
require "classes/Address.php";
require "classes/Company.php";
require "classes/Person.php";
require "classes/Worker.php";

$companyAddress = new Address("nám. I. P. Pavlova", "5", "Praha", "120 00", "Czechia");
$company = new Company(
    "Mews",
    $companyAddress,
    "https://www.mews.com/hs-fs/hubfs/mews-logo-2020.png?width=2088&name=mews-logo-2020.png",
    "https://www.mews.com"
);

$worker1 = new Worker(
    "Linh",
    "Le",
    new DateTimeImmutable("1995-01-20"),
    "Frontend Engineer",
    $company,
    "123 456 789",
    "linh.le@mews.com",
);
$worker2 = new Worker(
    "John",
    "Doe",
    new DateTimeImmutable("1996-04-24"),
    "Backend Engineer",
    $company,
    "987 654 321",
    "john.doe@mews.com",
);
$worker3 = new Worker(
    "Jane",
    "Doe",
    new DateTimeImmutable("1992-02-20"),
    "Product Manager",
    $company,
    "111 222 333",
    "jane.doe@mews.com",
    true
);

$workers = [$worker1, $worker2, $worker3];
?>

<main class="business-cards">
    <?php foreach ($workers as $worker) : ?>
        <?php require 'businessCard.php'; ?>
    <?php endforeach; ?>
</main>