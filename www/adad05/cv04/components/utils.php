<?php

function readFileContent($filePath)
{
    $fileContent = file_get_contents($filePath);
    return $fileContent;
}

function readFileLine($filePath, $lineNumber)
{
    $fileContent = readFileContent($filePath);
    $lines = explode("\n", $fileContent);
    return $lines[$lineNumber];
}

function writeToFileContent($filePath, $data)
{
    file_put_contents($filePath, $data);
}

function appendToFileContent($filePath, $data)
{
    file_put_contents($filePath, $data . PHP_EOL, FILE_APPEND);
}

function deleteLineFromFile($filePath, $lineNumber)
{
    $fileContent = readFileContent($filePath);
    $lines = explode("\n", $fileContent);
    array_splice($lines, $lineNumber, 1);
    $newFileContent = implode(PHP_EOL, $lines);
    writeToFileContent($filePath, $newFileContent);
}

function checkUserExists($filePath, $email)
{
    $fileContent = readFileContent($filePath);
    $lines = explode("\n", $fileContent);
    for ($i = 0; $i < count($lines); $i++) {
        $line = $lines[$i];
        if (!($line == '')) {
            $fields = explode(";", $line);
            if ($fields[1] == $email) {
                return true;
            }
        }
    }
    return false;
}

function attemptAuthentication($filePath, $email, $password)
{
    $fileContent = readFileContent($filePath);
    $lines = explode("\n", $fileContent);
    for ($i = 0; $i < count($lines); $i++) {
        $line = $lines[$i];
        if (!($line == '')) {
            $fields = explode(";", $line);
            if ($fields[1] == $email) {
                if ($fields[2] == $password) {
                    return true;
                }
            }
        }
    }
    return false;
}
