<?php

function readFileContent($fileName)
{
    $fileContent = file_get_contents($fileName);
    return $fileContent;
}

function readFileLines($fileName, $lineNumber)
{
    $fileContent = readFileContent($fileName);
    $lines = explode(PHP_EOL, $fileContent);
    return $lines[$lineNumber + 1];
}

function writeFileContent($fileName, $content)
{
    file_put_contents($fileName, $content);
}

function appendFileContent($fileName, $content)
{
    file_put_contents($fileName, $content . PHP_EOL, FILE_APPEND);
}

function deleteLine($fileName, $lineNumber)
{
    $fileContent = readFileContent($fileName);
    $lines = explode(PHP_EOL, $fileContent);
    $newLines = array_splice($lines, $lineNumber, 1);
    $newContent = implode(PHP_EOL, $newLines);
    writeFileContent($fileName, $newContent);
}
