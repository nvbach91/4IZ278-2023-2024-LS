<?php

function fetchUsers() {
    $users = file_get_contents(__DIR__ . "/users.db");
    $userLines = explode(PHP_EOL, $users);

    $userEmailsParsed = [];
    for ($i = 0; $i < count($userLines); $i++) {
        if (trim($userLines[$i]) == "") {
            continue;
        }
        $userLine = explode(";", $userLines[$i]);
        $userEmail = [
            "email" => $userLine[1]
        ];

        array_push($userEmailsParsed, $userEmail);
    }
    return $userEmailsParsed;
}

function fetchUser($email) {
    $users = file_get_contents(__DIR__ . "/users.db");
    $userLines = explode(PHP_EOL, $users);

    for ($i = 0; $i < count($userLines); $i++) {
        $userLine = explode(";", $userLines[$i]);
        if ($userLine[1] == $email) {
            return [
                "name" => $userLine[0],
                "email" => $userLine[1],
                "password" => $userLine[2],
            ];
        }
    }
    return null;
}

function registerNewUser($name, $email, $password, $checkAvailability = false) {
    $userEmails = fetchUsers();

    if ($checkAvailability == true) {
        foreach ($userEmails as $userEmail) {
            if ($userEmail["email"] == $email) {
                return "taken";
            }
        }
    } else {
        $newParsedUser = $name . ";" . $email . ";" . $password;
        file_put_contents(__DIR__ . "/users.db", $newParsedUser . PHP_EOL, FILE_APPEND);


        $to = $email;
        $subject = "Registration success!";
        $txt = "Hello, $name,

        this is a confirmation e-mail that your registration on address https://eso.vse.cz/~mald16/cv04/ was successful.

        Best regards,
        The WebDev guy
        ";
        $headers  = "From: The WebDev guy <thewebdevguy@eso.vse.cz>\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\n";

        mail($to, $subject, $txt, $headers);
        header('Location: ' . "login.php?email=$email");
    }
}

function authenticate($email, $password) {
    if (fetchUser($email) == null) {
        return ["error", "This account doesn't exist. Feel free to create one <a href='./registration.php' style='color: rgb(88, 21, 28)'>here</a>."];
    } else {
        if (fetchUser($email)["password"] == $password) {
            return ["success", "Login was successful."];
        }
        return ["error", "Incorrect password."];
    }
}
