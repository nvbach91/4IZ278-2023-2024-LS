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
        if ($fields[1] == $email) {
            return true;
        }
    }
    return false;
}
function readFileLine($filePath, $lineNumber) {
    $fileContent = readFileContent($filePath);
    $lines = explode(PHP_EOL, $fileContent);
    return $lines[$lineNumber];
}
function writeFileContent($filePath, $data) {
    file_put_contents($filePath, $data);
}
function appendFileContent($filePath, $data) {
    file_put_contents($filePath, $data . PHP_EOL, FILE_APPEND);
}
function deleteLineFromFile($filePath, $lineNumber) {
    $fileContent = readFileContent($filePath);
    $lines = explode(PHP_EOL, $fileContent);
    array_splice($lines, $lineNumber, 1);
    $newFileContent = implode(PHP_EOL, $lines);
    file_put_contents($filePath, $newFileContent);
}
?>