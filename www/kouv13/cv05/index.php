<?php
require "db.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MYSQL</title>
</head>

<body>
    <h2>Údaje k DB</h2>
    <?php
    echo 'hn: ' . DB_HOSTNAME . ', dn: ' . DB_NAME . ', un: ' . DB_USERNAME;
    ?>

    <h2>Připojení k DB</h2>
    <?php
    $tables = $playersDB->getTables();
    foreach ($tables as $table) {
        echo 'Tabulka ' . $table["table_name"] . ' nalezena.<br>';
    }
    ?>

    <h2>Volání metod</h2>
    <?php
    echo $playersDB->create('name') . '<br>' . $playersDB->delete('name') . '<br>' . $playersDB->update('name', 'name') . '<br>' . $playersDB->find('name') . '<br><br>';
    echo $matchesDB->create('name') . '<br>' . $matchesDB->delete('name') . '<br>' . $matchesDB->update('name', 'name') . '<br>' . $matchesDB->find('name') . '<br><br>';
    echo $teamsDB->create('name') . '<br>' . $teamsDB->delete('name') . '<br>' . $teamsDB->update('name', 'name') . '<br>' . $teamsDB->find('name');
    ?>

</body>

</html>