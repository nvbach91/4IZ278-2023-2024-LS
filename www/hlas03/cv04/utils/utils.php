<?php

function readFileContent($filePath) {
    $fileContent = file_get_contents($filePath);
    return $fileContent;
}
function checkUserExists($filePath, $email) {
    $fileContent = readFileContent($filePath);
    $lines = explode(PHP_EOL, $fileContent);
    for ($i = 0; $i < count($lines); $i++) {
        $line = $lines[$i];
        $fields = explode(';', $line);
        if (isset($fields[1]) && $fields[1] == $email) {
            return true;
        }
    }
    return false;
}

function fetchUsers($filePath) {
    $users = array();
    $fileContent = readFileContent($filePath);
    $lines = explode(PHP_EOL, $fileContent);
    
    foreach ($lines as $line) {
        $fields = explode(';', $line);
        if (count($fields) >= 2) {

            $email = $fields[1];
            $users[$email] = array(
                'name' => $fields[0],
                'email' => $fields[1],
                'password' => $fields[2]
            );
        }
    }
    return $users;
}

function fetchUser($filePath, $email) {
    $fileContent = readFileContent($filePath);
    $lines = explode(PHP_EOL, $fileContent);
    
    foreach ($lines as $line) {
        $fields = explode(';', $line);
        if (isset($fields[1]) && $fields[1] === $email) {
            $user = array(
                'name' => $fields[0], 
                'email' => $fields[1],
                'password' => $fields[2],
            );
            return $user;
        }
    }
    
    return null;
}

function authenticate($filePath, $email, $password) {
    $fetchUser = fetchUser($filePath, $email);
    if (isset($fetchUser)) {
        if ($fetchUser["email"] == $email && $fetchUser["password"] == $password) {
            return true;
        }
    }
    return false;
}

function registerNewUser($filename, $name, $email, $password) {
    $users = fetchUsers($filename);
    if (isset($users[$email])) {
        return "Email already registered";
    }
    $data = implode(";", [$name, $email, $password]) . PHP_EOL;
    file_put_contents($filename, $data, FILE_APPEND);

    mail($email, "Registration successful", "Thank you for your registration");

    return "Registration successful";
}

?>