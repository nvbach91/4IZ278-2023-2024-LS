<?php

require "./utils/fs.php";
require "./utils/navigation.php";

$fileName = "./users.db";

$fetchUsers = function () use ($fileName) {
    $fileContent = readFileContent($fileName);
    $lines = explode(PHP_EOL, $fileContent);
    $users = [];
    foreach ($lines as $line) {
        if (empty($line)) {
            continue;
        }
        $user = explode(";", $line);
        $user = [
            "name" => $user[0],
            "email" => $user[1],
            "password" => $user[2],
        ];
        array_push($users, $user);
    }
    return $users;
};

$fetchUser = function ($email) use ($fileName) {
    $fileContent = readFileContent($fileName);
    $lines = explode(PHP_EOL, $fileContent);
    foreach ($lines as $line) {
        if (empty($line)) {
            continue;
        }
        $user = explode(";", $line);
        if ($user[1] == $email) {
            return [
                "name" => $user[0],
                "email" => $user[1],
                "password" => $user[2],
            ];
        }
    }
    return null;
};

$checkIfUserExists = function ($email) use ($fetchUsers) {
    $users = $fetchUsers();
    foreach ($users as $user) {
        if ($user['email'] == $email) {
            return true;
        }
    }
    return false;
};

$registerUser = function ($name, $email, $password) use ($fileName, $checkIfUserExists) {
    $userExists = $checkIfUserExists($email);
    if ($userExists) {
        throw new Exception("User with email '$email' already exists");
    }
    $userRecord = implode(";", [
        $name,
        $email,
        $password,
    ]);
    appendFileContent($fileName, $userRecord);
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
    redirectToUrl('login.php', ['email' => $email]);
};

$authenticate = function ($email, $password) use ($fetchUser) {
    $user = $fetchUser($email);
    if ($user == null) {
        throw new Exception("User with email '$email' does not exist");
    }
    if ($user['password'] == $password) {
        return $user;
    }
    throw new Exception("Invalid password");
};
