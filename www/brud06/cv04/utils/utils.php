<?php


function readFileContent($filePath)
{
    $fileContent = file_get_contents($filePath);
    return $fileContent;
}

function readFileLine($filePath, $lineNumber)
{
    //lineNumber je index radku nikoliv cislo radku
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
        if (count($fields) > 1 && $fields[1] == $email) {
            return true;
        }
    }
    return false;
}

function writeFileContent($filePath, $data)
{
    file_put_contents($filePath, $data);
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
    file_put_contents($filePath, $newFileContent);
    //O N složitost
}
function fetchUsers($filePath)
{
    $fileContent = readFileContent($filePath);
    $lines = explode(PHP_EOL, $fileContent);
    $users = [];
    foreach ($lines as $line) {
        if (empty($line)) {
            continue;
        }
        $fields = explode(';', $line);
        if (count($fields) > 1) {
            $users[$fields[1]] = [
                'name' => $fields[0],
                'email' => $fields[1],
                'password' => $fields[2]
            ];
        }
    }
    return $users;
}

function fetchUser($filePath, $email)
{
    $users = fetchUsers($filePath);
    return $users[$email] ?? null;
}
function registerNewUser($filePath, $user)
{
    $users = fetchUsers($filePath);
    if (array_key_exists($user['email'], $users)) {
        return false;
    }
    $newUser = implode(';', $user);
    file_put_contents($filePath, $newUser . PHP_EOL, FILE_APPEND);
    return true;
}
function authenticate($filePath, $email, $password)
{
    $user = fetchUser($filePath, $email);
    if ($user === null) {
        return "User does not exist";
    } else if ($user['password'] === $password) {
        return true;
    } else {
        return false;
    }
}
function sendEmail($recipient, $subject, $message)
{
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: brud06@vse.cz' . "\r\n";
    $headers .= 'Reply-to: brud06@vse,cz' . "\r\n";
    $headers .= 'X-Mailer: PHP/' . phpversion();

    return mail($recipient, $subject, $message, $headers);
}
