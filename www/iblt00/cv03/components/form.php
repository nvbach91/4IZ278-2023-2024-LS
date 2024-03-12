<?php

// Error checking vars
$invalidInputs = [];
$alertMessages = [];
$alertType = 'alert-fail';

// check if form is submitted
$submittedForm = !empty($_POST);
if ($submittedForm) {
    // get all fields while trimming them and converting any special chars to html entities
    $name = htmlspecialchars(trim($_POST['name']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $avatarURL = htmlspecialchars(trim($_POST['avatarURL']));
    $deckName = htmlspecialchars(trim($_POST['deckName']));
    $cardCount = htmlspecialchars(trim($_POST['cardCount']));

    // check for empty name
    if (!$name) {
        array_push($alertMessages, 'Please enter your name');
        array_push($invalidInputs, 'name');
    }

    // check for bad gender
    if (!in_array($gender, ['F', 'M', 'O'])) {
        array_push($alertMessages, 'Please select a gender');
        array_push($invalidInputs, 'gender');
    }

    // check for bad email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($alertMessages, 'Please use a valid email');
        array_push($invalidInputs, 'email');
    }

    // check for bad phone number
    if (!preg_match('/^(\+\d{3} ?)?(\d{3} ?){3}$/', $phone)) {
        array_push($alertMessages, 'Please use a valid phone number');
        array_push($invalidInputs, 'phone');
    }

    // check for bad avatar URL
    if (!filter_var($avatarURL, FILTER_VALIDATE_URL)) {
        array_push($alertMessages, 'Please use a valid URL for your avatar');
        array_push($invalidInputs, 'avatarURL');
    }

    //check for empty deck name
    if (!$deckName) {
        array_push($alertMessages, "Please enter your deck's name");
        array_push($invalidInputs, 'deckName');
    }

    //check for empty number of cards in deck
    if (!$cardCount) {
        array_push($alertMessages, 'Please enter number of cards of your deck');
        array_push($invalidInputs, 'cardCount');
    }
    //check for number of cards in deck
    elseif ($cardCount < 22 || $cardCount > 30) {
        array_push($alertMessages, 'Please enter valid number of cards (hint: 22-30)');
        array_push($invalidInputs, 'cardCount');
    }

    // if no errors at all: display success
    if (!count($alertMessages)) {
        $alertType = 'alert-success';
        $alertMessages = ['Your registration for the tournament was successful'];
    }
}
