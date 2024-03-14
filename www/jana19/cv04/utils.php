<?php

function readFileContent($filePath) {
    $fileContent = file_get_contents($filePath);
    return $fileContent;
}

function readFileLine($filePath, $lineNumber) {
    $fileContent = readFileContent($filePath);
    $lines = explode(PHP_EOL, $fileContent);
    return $lines[$lineNumber];
}

function checkUserExists($filePath, $email) {
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

function writeFileContent($filePath, $data) {
    file_put_contents($filePath, $data . PHP_EOL, FILE_APPEND);
}

function appendFileContent($filePath, $data) {
    file_put_contents($filePath, $data, FILE_APPEND);
}

function deleteFromFile($filePath, $lineNumber) {
    $fileContent = readFileContent($filePath);
    $lines = explode(PHP_EOL, $fileContent);
    array_splice($lines, $lineNumber, 1);
    $newFileContent = implode(PHP_EOL, $lines);
    file_put_contents($filePath, $newFileContent);
}

// nechápu rozdíl mezi " fetchUsers -  pro načítání záznamů o uživateli" a "fetchUser - pro vyhledávání jednoho uživatele podle e-mailu ze souboru" ?
// obojí popisuje že jdu, prohledám soubor a když najdu ten stejný email, tak vrátím data o tom jednom uživateli
function fetchUsers($filePath, $email) {
    $fileContent = readFileContent($filePath);
    $lines = explode(PHP_EOL, $fileContent);
    for ($i = 0; $i < count($lines); $i++) {
        $line = $lines[$i];
        $fields = explode(';', $line);
        if ($fields[1] == $email) {
            $emailKey = $email;
            return $emailKey;
        }
    }
    return null;
}
// tak jsem to rozdělila že funkce výše vyhodí PK
// a pouze pokud se nějaký najde, tak se půjdou dohledat data
function fetchUser($filePath, $emailKey) {
    $fileContent = readFileContent($filePath);
    $lines = explode(PHP_EOL, $fileContent);
    for ($i = 0; $i < count($lines); $i++) {
        $line = $lines[$i];
        $fields = explode(';', $line);
        if ($fields[1] == $emailKey) {
            $userRecordFound = [$fields[0], $fields[1], $fields[2], $fields[3], $fields[4], $fields[5], $fields[6], $fields[7]];
            return $userRecordFound;
        }
    }
    return null;
}

function authenticate($filePath, $email, $password) {
    $emailKey = fetchUsers($filePath, $email);
    $userRecordFound = fetchUser($filePath, $emailKey);
    if ($userRecordFound[7] == $password) {
        return true;
    }
    else {
        return false;
    }



}

?>