<?php

// Function to register a new user
function register_new_user($name, $email, $password) {
    $user = fetch_user($email);
    if (isset($user)) {
        return "Uživatel již existuje";
    } else {
        $new_user = implode(";", [
            $email,
            $name,
            password_hash($password, PASSWORD_DEFAULT)
        ]);
        file_put_contents(USERS_DB, $user . PHP_EOL, FILE_APPEND); 

        $msg = "Dobrý den, byl jste úspěšně zaregistrován";
        $headers = array(
            "MIME-Version" => "1.0",
            "Content-type" => "text/html; charset=utf-8",
            "From" => "davj05@vse.cz"
        );
        mail($email, "Registrace byla úspěšná", wordwrap($msg,70), $headers);
        return "Nyní se můžte přihlásit.";
    }
}

// Function to fetch a user by email
function fetch_user($email) {
    $users = fetch_users(USERS_DB);
    return isset($users[$email]) ? $users[$email] : null;
}

// Function to fetch all users from the database
function fetch_users($filename) {
    $users = [];
    $file = fopen($filename, "r");

    if ($file) {
        while (($line = fgetcsv($file, 0, ";")) !== FALSE) {
            if (count($line) > 1) {
                $users[$line[1]] = [
                    "name" => $line[0],
                    "email" => $line[1],
                    "password" => $line[2]
                ];
            }
        }
        fclose($file);
    }

    return $users;
}

function login_user($email, $password) {
    $user = fetch_user($email);
    if (!$user) {
        return "Uživatel neexistuje";
    } else {
        if (password_verify($password, $user["password"])) {
            return "Uspěchsně přihlášen";
        } else {
            return "Špatné heslo";
        }
    }
}

?>