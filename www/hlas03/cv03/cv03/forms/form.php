<?php
if (!empty($_POST)){
    // mame data neboli formular byl odeslan pomovi metody POST
    $name = htmlspecialchars(trim($_POST["name"]));
    $gender = htmlspecialchars(trim($_POST["gender"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $phone = htmlspecialchars(trim($_POST["phone"]));
    $avatar = htmlspecialchars(trim($_POST["avatar"]));
    $package_name = htmlspecialchars(trim($_POST["package_name"]));
    $amount_of_cards = htmlspecialchars(trim($_POST["amount_of_cards"]));
    $succesMessage = null;


    $errors = [];

    // user.name@domain.realm
    if (strlen($name) < 3){
        array_push($errors, "$name must have 3 or more characters!");
    }
    if ($gender == null){
        array_push($errors, "must choose gender!");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        array_push($errors, "$email is not valid!");
    }
    if (!preg_match("/^(\\+\\d{2,})( ?\\d{3}){3}$/", $phone)){
        array_push($errors, "$phone invalid phone number format");
    }
    if (!filter_var($avatar, FILTER_VALIDATE_URL)){
        array_push($errors, "$avatar is not valid!");
    }
    if (strlen($package_name) < 3){
        array_push($errors, "$package_name must have 3 or more characters!");
    }
    if (!($amount_of_cards > 0)){
        array_push($errors, "$package_name must contain some cards!");
    }
    if (count($errors) == 0) {
        $succesMessage = "Thank you for your registration";
    }
}

?>