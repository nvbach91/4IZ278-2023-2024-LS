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

function checkUserExist($filePath, $email) {
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

function checkCorrectPasword($filePath, $email, $password) {
    
        $fileContent = readFileContent($filePath);
        $lines = explode(PHP_EOL, $fileContent);
        for ($i = 0; $i < count($lines); $i++) {
            $line = $lines[$i];
            $fields = explode(';', $line);
            if ($fields[1] == $email && $fields[2] == $password) {
                return true;
            }
        
    }
    return false;
}

function writeFileContent($filePath, $data) {
    file_put_contents($filePath, $data);
}

function appendFileContent($filePath, $data) {
    if (readFileContent($filePath) != null) {
        file_put_contents($filePath, PHP_EOL . $data, FILE_APPEND);
    } else {
        file_put_contents($filePath, $data, FILE_APPEND);
    }
    
}

function deleteLineFromFile($filePath, $lineNumber) {
    $fileContent = readFileContent($filePath);
    $lines = explode(PHP_EOL, $fileContent);
    array_splice($lines, $lineNumber, 1);
    $newFileContent = implode(PHP_EOL, $lines);
    file_put_contents($filePath, $newFileContent);
}

?>