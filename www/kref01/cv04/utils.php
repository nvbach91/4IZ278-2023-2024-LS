<?php
function appendFileContent($filePath, $data) {
    file_put_contents($filePath, $data . PHP_EOL, FILE_APPEND);
}
function fetchUsers($filePath) {
    $users = [];
    $fileContent = file_get_contents($filePath);
    $lines = explode(PHP_EOL, $fileContent);
    foreach ($lines as $line) {
        if (!empty($line)) {
            list($name, $email, $password) = explode(';', $line);
            $users[$email] = [
                'name' => $name,
                'email' => $email,
                'password' => $password,
            ];
        }
    }
    return $users;
}
function fetchUser($filePath, $searchEmail) {
    $fileContent = file_get_contents($filePath);
    $lines = explode(PHP_EOL, $fileContent);
    foreach ($lines as $line) {
        if (!empty($line)) {
            list($name, $email, $password) = explode(';', $line);
            if ($email == $searchEmail) {
                return [
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                ];
            }
        }
    }
    return null;
}
function registerNewUser($filePath, $errors, $name, $email, $password) {
    $users = fetchUsers($filePath);
    if (array_key_exists($email,$users)) {
        return false;
    }
    $data = $name . ";" . $email . ";" . $password;
    appendFileContent($filePath, $data);
    return true;
}
function authenticate($filePath, $email, $password) {
    $user = fetchUser($filePath, $email);
    if ($user == null ) {
        return false;
    }
    if ($user['password'] === $password) {
        return true;
    }
    return false;
}
?>