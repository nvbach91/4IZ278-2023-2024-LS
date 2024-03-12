<?php
include 'includes/head.php';
$validProfilePictureUrl = false;
if(!empty($_POST)){
    $name = $_POST['name'];
    $sex = $_POST['sex'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $profilePictureUrl = $_POST['profilePictureUrl'];
    $deckName = $_POST['deckName'];
    $numberOfCardsInDeck = $_POST['numberOfCardsInDeck'];
    $errorMessages = [];
    if (empty($_POST['name']) || !strpos(trim($_POST['name']),' ')){
        $errorMessages[] = 'Please enter your full name';
    }
    if (empty($_POST['email']) || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
        $errorMessages[] = 'Please enter a valid email';
    }
    if (!empty($_POST['phone'])){
        if (!is_numeric($_POST['phone'])){
            $errorMessages[] = 'Please enter a valid phone number';
        }
    }
    if (empty($_POST['profilePictureUrl']) || !filter_var($_POST['profilePictureUrl'],FILTER_VALIDATE_URL)){
        $errorMessages[] = 'Please enter a valid profile picture URL';
        
    }else{
        $validProfilePictureUrl = true;
    }
    if (empty($_POST['deckName'])){
        $errorMessages[] = 'Please enter a deck name';
    }
    if (empty($_POST['numberOfCardsInDeck']) || !is_numeric($_POST['numberOfCardsInDeck'])){
        $errorMessages[] = 'Please enter a valid number of cards in the deck';
    }
    if (!empty($errorMessages)){
        require 'includes/error.php';
    }

}

require 'includes/form.php';

include 'includes/foot.php';
?>
