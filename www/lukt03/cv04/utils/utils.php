<?php

define('USERS_DB', __DIR__ . '/../users.db');

function readFileContent($filePath) {
    $fileContent = file_get_contents($filePath);
    return $fileContent;
}

function readFileLine($filePath, $lineNumber) {
    $fileContent = readFileContent($filePath);
    $lines = explode(PHP_EOL, $fileContent);
    return $lines[$lineNumber];
}

function writeFileContent($filePath, $data) {
    file_put_contents($filePath, $data);
}

function appendFileContent($filePath, $data) {
    file_put_contents($filePath, $data . PHP_EOL, FILE_APPEND);
}

function deleteLineFromFile($filePath, $lineNumber) {
    $fileContent = readFileContent($filePath);
    $lines = explode(PHP_EOL, $fileContent);
    array_splice($lines, $lineNumber, 1);
    $newFileContent = implode(PHP_EOL, $lines);
    file_put_contents($filePath, $newFileContent);
}

function fetchUsers() {
    $usersData = readFileContent(USERS_DB);
    $userLines = explode(PHP_EOL, $usersData);
    $users = [];

    foreach ($userLines as $userLine) {
        if (empty(trim($userLine))) {
            continue;
        }
        $fields = explode("\t", $userLine);
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

function fetchUser($wantedEmail) {
    $users = fetchUsers();

    foreach ($users as $userEmail => $userData) {
        if ($wantedEmail == $userEmail) {
            return array(
                'email' => $userEmail,
                'name' => $userData['name'],
                'passwordHash' => $userData['passwordHash']
            );
        }
    }

    return null;
}

function registerNewUser($email, $name, $password) {
    if (checkUserExists($email)) {
        return false;
    }
    $userRecord = implode("\t", [
        $email,
        $name,
        password_hash($password, PASSWORD_DEFAULT)
    ]);
    appendFileContent(USERS_DB, $userRecord);

    $headers = array(
        'MIME-Version' => '1.0',
        'Content-type' => 'text/html; charset=utf-8',
        'From' => 'lukt03@vse.cz'
    );
    mail(
        $email,
        "Registration to My App",
        "Dear $name, you were succesfully registered to My App. You can now log in <a href='https://eso.vse.cz/~lukt03/cv04/login.php'>here</a>.",
        $headers
    );

    return true;
}

function checkUserExists($email) {
    if (is_null(fetchUser($email))) {
        return false;
    }

    return true;
}

function authenticate($email, $password) {
    $user = fetchUser($email);
    if (is_null($user)) {
        return null;
    }

    if (password_verify($password, $user['passwordHash'])) {
        return $user;
    }

    return null;
}
