<?php
if (!empty($_POST)) {
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $phone = htmlspecialchars(trim($_POST["phone"]));
    $avatar = htmlspecialchars(trim($_POST["avatar"]));
    $gender = htmlspecialchars(trim($_POST["gender"]));
    $deckName = htmlspecialchars(trim($_POST["deckName"]));
    $numberOfCards = htmlspecialchars(trim($_POST["numberOfCards"]));

    $errors = [];

    if (empty($name)) {
        array_push($errors, "Name is required");
    } elseif (strlen($name) < 3) {
        array_push($errors, "Name must have 3 or more characters");
    }

    if (empty($email)) {
        array_push($errors, "Email is required");
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "'$email' is not a valid email");
    }

    if (empty($phone)) {
        array_push($errors, "Phone is required");
    } elseif (!preg_match('/^\+?(\d{1,3})?[-.\s]?\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{3}$/', $phone)) {
        array_push($errors, "'$phone' is not a valid phone number");
    }

    if (empty($avatar)) {
        array_push($errors, "Avatar URL is required");
    } elseif (!filter_var($avatar, FILTER_VALIDATE_URL)) {
        array_push($errors, "'$avatar' is not a valid URL");
    }

    if (empty($deckName)) {
        array_push($errors, "Deck name is required");
    } elseif (strlen($deckName) < 3) {
        array_push($errors, "Deck name must have 3 or more characters");
    }

    if (empty($numberOfCards)) {
        array_push($errors, "Number of cards is required");
    } elseif (!filter_var($numberOfCards, FILTER_VALIDATE_INT)) {
        array_push($errors, "Number of cards must be an integer");
    } else {
        $numberOfCardsInt = intval($numberOfCards);
        if ($numberOfCardsInt < 50) {
            array_push($errors, "Number of cards must be at least 50");
        }
        if ($numberOfCardsInt > 70) {
            array_push($errors, "Number of cards must be at most 70");
        }
    }

    if (count($errors) == 0) {
        $successMessage = "Thank you for your registration";
        $to = $email;
        $subject = "Registration successful";
        $message = "<h1>Thank you for your registration</h1>";
        $headers = [
            'MIME-Version: 1.0',
            'Content-Type: text/html',
            'From: lean04@vse.cz',
            'Reply-To: lean04@vse.cz',
            'X-Mailer: PHP/' . phpversion(),
        ];
        mail($to, $subject, $message, implode("\r\n", $headers));
    }
}
