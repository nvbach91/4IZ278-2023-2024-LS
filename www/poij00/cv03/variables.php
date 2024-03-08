<?php 
if(!empty($_POST)) {
    $name = htmlspecialchars(trim($_POST['name']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $avatar = htmlspecialchars(trim($_POST['avatar']));
    $cardGame = htmlspecialchars(trim($_POST['card-game']));
    $noCards = htmlspecialchars(trim($_POST['no-cards']));

    $errors = [];
    // email - user.name@domain.realm
    if (strlen($name) < 3 || !preg_match('/^[a-zA-Zá-žÁ-Ž\s]+$/u', $name)) {
        array_push($errors,  "$name must have 3 or more characters, fill in your full name!");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors,  "$email is not valid email!");
    } 

    if (!preg_match('/^(\+420|00420)?\s?(\d{3})\s?(\d{3})\s?(\d{3})$/', $phone)) {
        array_push($errors,  "$phone is not a valid phone number. e.g. +420 733 333 999!");
    };

    if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
        array_push($errors,  "$avatar is not valid!");
    } 

    if (empty($cardGame)) {
        array_push($errors, "choose a card game from the list!");
    }

    if (empty($noCards)) {
        array_push($errors, "choose number of cards from the list!");
    }

    if (count($errors) == 0) {
        $successMessage = 'Thank you for registration';
    }
    
}

?>