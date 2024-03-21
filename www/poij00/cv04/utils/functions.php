<?php 
function readFileContent ($filePath) {
    $fileContent = file_get_contents($filePath);
    return $fileContent;
}

function lines ($filePath) {
    $fileContent = file_get_contents($filePath);
    $lines = explode("\n", $fileContent); // Rozdělí obsah na řádky
    return $lines;
}

function appendFileContent($filePath, $data) {
    file_put_contents($filePath, $data, FILE_APPEND);
}

function isEmail($filePath) {
    $emails = [];
    $lines = lines($filePath);
    for ($i = 0; $i < count($lines); $i++) {  
        $line = $lines[$i];
        $fields = explode(';', $line);
        if(isset($fields[1])) {
            array_push($emails, $fields[1]);
        }
    }
}

function fetchUser($filePath, $email) {
    $fileContent = readFileContent($filePath);
    $contentArray = explode(PHP_EOL, $fileContent);
    $finalLine = [];

    for ($i = 0; $i < count($contentArray); $i++) {
        $line = $contentArray[$i];
        $values = explode(';', $line);
        if ($values[1] == $email) {
            array_push($finalLine, $values);
        }
    }
    return $finalLine;
}

function registerNewUser($filePath, $email, ) {
    $userEmail = fetchUser($filePath, $email);
    if (!empty($userEmail)) {
        return true;
    }
}
    
function authenticate($filePath, $email, $password) {
    $userLine = fetchUser($filePath, $email);
    if(empty($userLine)) {
        return "User does not exists.";
    } else if ($password == $userLine[0][2]) {
        return "You have been successfuly logged in.";
    } else {
        return "Wrong password.";
    }
}



?>