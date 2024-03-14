<?php

$fileName = './users.txt';
// funkce kompletně přepíše obsah
// file_put_contents($fileName, 'test text');

// přidá nový obsah jako další znak
//file_put_contents($fileName, "test text", FILE_APPEND);
// \n přidá nový řádek - ale to není stejné pro všechny OS, takž je lepší použít konstantu PHP_EOL (end of line)
//file_put_contents($fileName, "\ntest text", FILE_APPEND);
file_put_contents($fileName, PHP_EOL . "test text", FILE_APPEND);

// read file
$fileContent = file_get_contents($fileName);

// příprava k odebrání prvku
//var_dump($fileContent);
// parametry: oddělovač, string
$lines = explode(PHP_EOL, $fileContent);

//var_dump($lines);

// odebrání prvku
// string, index, kolik
array_splice($lines, 3, 1);

// zpětný zápis do souboru
$newContent = implode(PHP_EOL, $lines);

//var_dump($newContent);
file_put_contents($fileName, $newContent);

?>

<h1><?php echo $fileContent; ?></h1>

