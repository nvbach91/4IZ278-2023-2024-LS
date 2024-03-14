<?php

$filePath = './users.db';
function readFileContent($filePath)
{
    $fileContent = file_get_contents($filePath);
    return $fileContent;
}

function writeFileContent($filePath, $data)
{
    file_put_contents($filePath, $data);
}

function registerNewUser($fullName, $email, $password, $filePath)
{
    $userRecord = implode(';', [
        $fullName,
        $email,
        $password
    ]);
    appendFileContent($filePath, $userRecord);
    $message = "Děkujeme za registraci na úplně zbytečný stránce!";
    $message = wordwrap($message, 70, "\r\n");
    mail($email, 'Registrace', $message);
}

function appendFileContent($filePath, $data)
{
    file_put_contents($filePath, $data . PHP_EOL, FILE_APPEND);
}

function deleteLineFromFile($filePath, $lineNumber)
{
    $fileContent = readFileContent($filePath);
    $lines = explode(PHP_EOL, $fileContent);
    array_splice($lines, $lineNumber, 1);
    $newFileContent = implode(PHP_EOL, $lines);
    writeFileContent($filePath, $newFileContent);
}

function getUser($filePath, $lineNumber)
{
    $fileContent = readFileContent($filePath);
    $lines = explode(PHP_EOL, $fileContent);
    return $lines[$lineNumber];
}

function checkUserExists($filePath, $email)
{
    $fileContent = readFileContent($filePath);
    $lines = explode(PHP_EOL, $fileContent);
    for ($i = 0; $i < count($lines); $i++) {
        $line = $lines[$i];
        $fields = explode(';', $line);
        if ($fields[1] == $email) {
            return true;
        }
    }
    return false;
}

function fetchUsers($filePath)
{
    $fileContent = readFileContent($filePath);
    $userLines = explode(PHP_EOL, $fileContent);
    $users = [];

    for ($i = 0; $i < count($userLines); $i++) {
        $fields = explode(';', $userLines[$i]);
        $user = [
            'email' => $fields[1],
            'name' => $fields[0]
        ];
        array_push($users, $user);
    }
    $deleted = array_pop($users);
    return $users;
}

function fetchUser($filePath, $email)
{
    $fileContent = readFileContent($filePath);
    $lines = explode(PHP_EOL, $fileContent);
    for ($i = 0; $i < count($lines); $i++) {
        $line = $lines[$i];
        $fields = explode(';', $line);
        if ($fields[1] == $email) {
            return [$email, $fields[2]];
        }
    }
    return null;
}

function authenticate($filePath, $email, $password)
{
    $user = fetchUser($filePath, $email);
    if (!is_null($user)) {
        if ($user[1] == $password) {
            return "";
        }
        return "Špatné heslo.";
    }
    return "Tento uživatel neexistuje.";
}