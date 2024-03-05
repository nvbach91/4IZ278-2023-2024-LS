<?php
if (!empty($_POST)) {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $avatar = htmlspecialchars(trim($_POST['avatar']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $deckName = htmlspecialchars(trim($_POST['deck-name']));
    $deckCount = htmlspecialchars(trim($_POST['deck-count']));

    // Validace:
    $errors = [];
    if (strlen($name) < 3) {
        if (strlen($name) == 0) {
            array_push($errors, "Please, enter your name.");
        } else {
            array_push($errors, "Name '$name' must have 3 or more characters!");
        }
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if (strlen($email) == 0) {
            array_push($errors, "Please, enter your e-mail.");
        } else {
            array_push($errors, "E-mail address '$email' is not valid!");
        }
    }
    if (!preg_match('/^(\\+\\d{2,3})?( ?\\d{3}){3}$/', $phone)) {
        if (empty($phone) == 1) {
            array_push($errors, "Please, enter your phone number.");
        } else {
            array_push($errors, "Phone number '$phone' is not valid!");
        }
    }
    if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
        if (strlen($avatar) == 0) {
            array_push($errors, "Please, enter your avatar URL.");
        } else {
            array_push($errors, "Avatar URL '$avatar' is not valid!");
        }
    }

    if (strlen($deckName) == 0) {
        array_push($errors, "Please, enter your deck name.");
    } else if (strlen($deckName) < 3) {
        array_push($errors, "Deck name '$deckName' is too short!");
    }

    if (!is_numeric($deckCount) || $deckCount <= 0) {
        if (empty($deckCount) == 1) {
            array_push($errors, "Please, enter a number of cards in your deck greater than 1.");
        } else {
            array_push($errors, "'$deckCount' is either not a number or it is too short!");
        }
    }

    if (empty($errors)) {
        $to = "mald16@vse.cz";
        $subject = "Zpráva z ESA!";
        $txt = "Tato zpráva byla odeslaná z webu:
        
        Name: $name
        Gender: $gender
        E-mail: $email
        Phone: $phone
        Avatar URL: $avatar
        Deck name: $deckName
        Number of cards: $deckCount
        
        ";
        $headers = "From: webmaster@eso.vse.cz";
        $headers .= "Content-Type: text/html; charset=UTF-8";

        mail($to, $subject, $txt, $headers);
    }
}
