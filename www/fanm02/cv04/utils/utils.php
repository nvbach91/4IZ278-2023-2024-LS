<?php

define('USERS_DB', __DIR__ . '/../users.db');

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function cleanInput($input) {
    return htmlspecialchars(trim($input));
}

function readFileContent(){
    return file_get_contents(USERS_DB);
}

function appendFileContent($user){
    file_put_contents(USERS_DB, $user . PHP_EOL, FILE_APPEND); 
}

function fetchUsers() {
    $users = [];
    $file = readFileContent();

    $lines = explode(PHP_EOL, $file);

    foreach ($lines as $line) {
        if (empty(trim($line))) {
            continue;
        }

        $fields = explode(";", $line);

        if (sizeof($fields) != 3) {
            continue;
        }

        $users[$fields[0]] = array(
            'name' => $fields[1],
            'passwordHash' => $fields[2]
        );
    }

    return $users;
}

function fetchUser($email) {
    $users = fetchUsers();
    return isset($users[$email]) ? $users[$email] : null;
}



function registerNewUser($name, $email, $password) {
    $user = fetchUser($email);
    if (isset($user)) {
        return "Uživatel s tímto emailem již existuje.";
    } else {
        $new_user = implode(";", [
            $email,
            $name,
            password_hash($password, PASSWORD_DEFAULT)
        ]);
        appendFileContent($new_user);
        sendConfirmation($email);
        return "Registrace úspěšná. Nyní se můžete přihlásit.";
    }
}

function loginUser($email, $password) {
    $user = fetchUser($email);
    if (!$user) {
        return "Neexistující uživatel.";
    } else {
        if (password_verify($password, $user['passwordHash'])) {
            return "Přihlášení úspěšné.";
        } else {
            return "Špatné heslo.";
        }
    }
}

function sendConfirmation($email) {
    $msg = 'Thank you for your registration';
    $headers = array(
        'MIME-Version' => '1.0',
        'Content-type' => 'text/html; charset=utf-8',
        'From' => 'fanm02@vse.cz'
    );
    mail($email, 'Registrated successfully', wordwrap($msg,70), $headers);
}

?>