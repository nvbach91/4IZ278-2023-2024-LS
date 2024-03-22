<?php

// konfigurace pro připojení
const DB_HOSTNAME = 'localhost';
// const DB_DATABASE = 'starwars';
const DB_DATABASE = 'jana19';
const DB_USERNAME = 'jana19'; // na eso bude zde xname
const DB_PASSWORD = 'yohThietae3joochae';  // heslo do DB

// zde se vytvoří jedno připojení
class DatabaseConnection
{
    private static $pdo;
    public static function getPDOConnection()
    {
        if (!self::$pdo) { // pouze pokud není vytvořené připojení se vytvoří nové
            // na statickou proměnnou se odkazujeme přes self::
            self::$pdo = new PDO(
                'mysql:host=' . DB_HOSTNAME . ';dbname=' . DB_DATABASE,
                DB_USERNAME,
                DB_PASSWORD
            );
        }
        return self::$pdo;
    }
}

interface DatabaseOperations
{
    // zde bude CRUD
    public function create($data);
    public function find($query);
    public function update($query, $data);
    public function delete($query);
}

abstract class Database implements DatabaseOperations
{
    protected $pdo;
    public function __construct()
    {
        $pdo = DatabaseConnection::getPDOConnection();
    }
}

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
    <p>Nevím, jak to udělat aby se to vypsalo na stránce DB :/ </p>
    <p>Když jse měla reqire pro ty 3 třídy na té DB stránce, tak to padalo na chyby. Zkusila jsem i include, ale to mi taky padalo na chyby.</p>
    <ul>
        <a href="./database.php">DB</a>
        <a href="./PlayersDB.php">Players</a>
        <a href="./TeamsDB.php">Teams</a>
        <a href="./MatchesDB.php">Matches</a>
    </ul>

</body>

</html>