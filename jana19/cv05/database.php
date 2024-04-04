<?php

// // konfigurace pro připojení
// const DB_HOSTNAME = 'localhost';
// const DB_DATABASE = 'starwars';
// // const DB_DATABASE = 'jana19';
// const DB_USERNAME = 'root'; // na eso bude zde xname
// const DB_PASSWORD = '';  // heslo do DB

// require './constants.php';

// require './DatabaseConnection.php';
// require './DatabaseClass.php';
// require './DatabaseOperations.php';


// require './matches.php';
// require './MatchesDB.php';

// require './players.php';
// require './PlayersDB.php';

// require './teams.php';
// require './TeamsDB.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cv05</title>
</head>

<body>
    <h1>MySQL database demo</h1>
    <?php include './matches.php'; ?>
    <?php include './players.php'; ?>
    <?php include './teams.php'; ?>

</body>

</html>