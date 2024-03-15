<?php

function validateUser($name, $email, $password, $passwordC)
{
    $errors = [];
    if (empty($name) || strlen($name) < 3 || strlen($name) > 30 || is_numeric($name) || !preg_match('/^([A-Z][a-z]+)\s([A-Z][a-z]+)((\s([A-Z][a-z]+))?)+$/', $name)) {
        array_push($errors, "Enter valid name");
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Enter valid email");
    }
    if (empty($password)  || strlen($password) < 3 || strlen($password) > 30 || is_numeric($password)) {
        array_push($errors, "Enter valid password");
    } else {
        if ($password != $passwordC) {
            array_push($errors, "Enter matching passwords");
        }
    }
    return $errors;
}

function fetchAllUsers($file_path) {
    $lines = explode(PHP_EOL, readRAW($file_path));
    $users = [];
    foreach ($lines as $line) {
        $lineArr = explode(";", $line);
        if (!empty($lineArr[0]) && !empty($lineArr[1]) && !empty($lineArr[2])) {
        $user = [
            "name" => $lineArr[0],
            "email" => $lineArr[1],
            "password" => $lineArr[2],
        ];
        array_push($users, $user);
        }


    }
    return $users;
}

function readRAW($file_path)
{
    return file_get_contents($file_path);
}

function appendRAW($file_path, $content)
{
    file_put_contents($file_path, $content, FILE_APPEND);
}

function fetchUser($email, $file_path)
{
    $lines = explode(PHP_EOL, readRAW($file_path));
    if (count($lines) > 0) {
        return findUser($email, $lines);
    } else {
        return null;
    }
}
function findUser($email, $lines) {
    $foundUser = null;
    foreach ($lines as $line) {
        $lineArr = explode(";", $line);
        if (!empty($lineArr[1]) && $email == $lineArr[1]) {
            $foundUser = [
                "name" => $lineArr[0],
                "email" => $lineArr[1],
                "password" => $lineArr[2],
            ];
        }      
    }
    return $foundUser;
}

function registerNewUser($user, $filePath) {
    appendRAW($filePath,
     implode(';', [
        $user["name"],
        $user["email"],
        $user["password"],
     ]) . PHP_EOL);
}
