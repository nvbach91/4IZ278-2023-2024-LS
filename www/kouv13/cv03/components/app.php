<?php
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_POST)) {

    $fullName = htmlspecialchars(trim($_POST['full-name']));
    $sex = htmlspecialchars(trim($_POST['sex']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $imageURL = htmlspecialchars(trim($_POST['image']));
    $deck = htmlspecialchars(trim($_POST['deck']));
    $cardsNumber = htmlspecialchars(trim($_POST['cards-number']));



    if (empty($fullName)) {
        array_push($errors, 'Nevyplněné jméno.');
    } else if (strlen($fullName) < 3) {
        array_push($errors, 'Neplatné jméno. Musí mít alespoň 3 charaktery.');
    }

    if (empty($sex)) {
        array_push($errors, 'Nevyplněné pohlaví.');
    }

    if (empty($email)) {
        array_push($errors, 'Nevyplněný email.');
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, 'Neplatný formát emailu.');
    }

    if (empty($phone)) {
        array_push($errors, 'Nevyplněný telefon.');
    } else if (!preg_match('/^(?:\+420)?\d{9}$/', $phone)) {
        array_push($errors, 'Neplatný formát telefonu.');
    }

    if (empty($imageURL)) {
        array_push($errors, 'Nevyplněná URL profilové fotky.');
    } else if (!filter_var($imageURL, FILTER_VALIDATE_URL)) {
        array_push($errors, 'Neplatný formát URL.');
    }

    if (empty($deck)) {
        array_push($errors, 'Nevyplněné jméno balíčku.');
    } else if (strlen($deck) < 3) {
        array_push($errors, 'Neplatné jméno balíčku. Musí mít alespoň 3 charaktery.');
    }

    if (empty($cardsNumber)) {
        array_push($errors, 'Nevyplněný počet karet.');
    } else if (!is_numeric($cardsNumber)) {
        array_push($errors, 'Počet karet není číslo.');
    } else if ($cardsNumber < 0) {
        array_push($errors, 'Počet karet nemůže být záporné číslo.');
    }
}
