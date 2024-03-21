<?php
function readFileContent($filename) {
    if (file_exists($filename)) {
        return file_get_contents($filename);
    } else {
        return '';
    }
}

function appendToFile($filename, $content) {
    file_put_contents($filename, $content . PHP_EOL, FILE_APPEND);
}

function readFileLine($filename, $lineNumber) {
    $content = readFileContent($filename);
    $lines = explode(PHP_EOL, $content);
    return $lines[$lineNumber];
}
function getEmailsAndNames($filename) {
    $content = readFileContent($filename);
    $lines = explode(PHP_EOL, $content);
    $users = [];
    foreach ($lines as $line) {
        $data = explode(';', $line);
        $email = $data[0];
        $name = $data[1];
        $users[] = ['email' => $email, 'name' => $name];
    }
    return $users;
}

function userExists($filename, $email) {
    $content = readFileContent($filename);
    $lines = explode(PHP_EOL, $content);
    foreach ($lines as $line) {
        $data= explode(';', $line);
        if ($data[0] == $email) {
            return true;
        }
    }
    return false;
}

function getPasswordByEmail($filename, $email) {
    $content = readFileContent($filename);
    $lines = explode(PHP_EOL, $content);
    foreach ($lines as $line) {
        $data = explode(';', $line);
        if ($data[0] == $email) {
            return $data[2];
        }
    }
    return null;
}


?>
