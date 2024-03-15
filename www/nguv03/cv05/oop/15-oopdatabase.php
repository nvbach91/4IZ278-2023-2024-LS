<?php
$GLOBALS['logs'] = [];

const DB_HOSTNAME = 'localhost';
const DB_DATABASE = 'test';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';

class DatabaseConnection {
    private static $pdo;
    public static function getPDOConnection() {
        if (!self::$pdo) {
            self::$pdo = new PDO('mysql:host='. DB_HOSTNAME .';dbname=' . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // what is static::class?
            $GLOBALS['logs'][] = 'A connection to the database was established';
        } else {
            $GLOBALS['logs'][] = 'Reusing existing database connection';
        }
        return self::$pdo;
    }
    // this will get returned when one tries to stringify the instance with i.e. "echo" in method configInfo
    public static function printConfig() {
        return 'database config: host: ' . DB_HOSTNAME . ', dbname: ' . DB_DATABASE . ', username: ' . DB_USERNAME;
    }
}

interface DatabaseOperations {
    // note that these methods have no body
    // where are their bodies?
    public function create($args);
    public function find($query);
    public function update($query, $update);
    public function delete($query);
}

abstract class Database implements DatabaseOperations {
    protected $pdo;
    public function __construct() {
        $GLOBALS['logs'][] = static::class . ' was instantiated';
        $this->pdo = DatabaseConnection::getPDOConnection();
    }
    public function configInfo() {
        $GLOBALS['logs'][] = DatabaseConnection::printConfig();
    }
}

class PlayersDB extends Database {
    public function create($data) {
        $GLOBALS['logs'][] = 'You called ' . static::class . ' C method create(' . json_encode($data) . ')';
    }
    public function find($query) {
        $GLOBALS['logs'][] = 'You called ' . static::class . ' R method find(' . json_encode($query) . ')';
        // $statement = $this->pdo->prepare('SELECT * FROM players WHERE 1');
        // $statement->execute([]);
        // $players = $statement->fetchAll(PDO::FETCH_ASSOC);
        // foreach($players as $player) {
        //     $GLOBALS['logs'][] = 'Found ' . $player['name'];
        // }
        // $GLOBALS['logs'][] = 'Found ' . count($players) . ' player(s)';
    }
    public function update($query, $update) {
        $GLOBALS['logs'][] = 'You called ' . static::class . ' U method save(' . json_encode($query) . ', ' . json_encode($update) . ')';
    }
    public function delete($query) {
        $GLOBALS['logs'][] = 'You called ' . static::class . ' D method delete(' . json_encode($query) . ')';
    }
}

class TeamsDB extends Database {
    public function create($data) {
        $GLOBALS['logs'][] = 'You called ' . static::class . ' C method create(' . json_encode($data) . ')';
    }
    public function find($query) {
        $GLOBALS['logs'][] = 'You called ' . static::class . ' R method find(' . json_encode($query) . ')';
    }
    public function update($query, $update) {
        $GLOBALS['logs'][] = 'You called ' . static::class . ' U method save(' . json_encode($query) . ', ' . json_encode($update) . ')';
    }
    public function delete($query) {
        $GLOBALS['logs'][] = 'You called ' . static::class . ' D method delete(' . json_encode($query) . ')';
    }
}

class MatchesDB extends Database {
    public function create($data) {
        $GLOBALS['logs'][] = 'You called ' . static::class . ' C method create(' . json_encode($data) . ')';
    }
    public function find($query) {
        $GLOBALS['logs'][] = 'You called ' . static::class . ' R method find(' . json_encode($query) . ')';
    }
    public function update($query, $update) {
        $GLOBALS['logs'][] = 'You called ' . static::class . ' U method save(' . json_encode($query) . ', ' . json_encode($update) . ')';
    }
    public function delete($query) {
        $GLOBALS['logs'][] = 'You called ' . static::class . ' D method delete(' . json_encode($query) . ')';
    }
}

$playersDB = new PlayersDB();
$playersDB->configInfo();
$playersDB->create([ 'id' => 0, 'name' => 'Maradona',            'age' => 76 ]);
$playersDB->create([ 'id' => 1, 'name' => 'David Beckham',       'age' => 46 ]);
$playersDB->create([ 'id' => 2, 'name' => 'Cristiano Ronaldo',   'age' => 36 ]);
$playersDB->create([ 'id' => 3, 'name' => 'Ronaldinho',          'age' => 44 ]);
$playersDB->find([]);
$playersDB->find([ 'name' => 'Ronaldinho' ]);
$playersDB->find([ 'age' => 44 ]);
$playersDB->update([ 'id' => 2 ], ['name' => 'Ronaldoosiu' ]);
$playersDB->delete([ 'id' => 2 ]);
$playersDB->delete([ 'name' => 'David Beckham' ]);

$teamsDB = new TeamsDB();
$teamsDB->configInfo();
$teamsDB->create([ 'id' => 0, 'name' => 'FC Real Madrid' ]);
$teamsDB->create([ 'id' => 1, 'name' => 'FC Barcelona' ]);

$matchesDB = new MatchesDB();
$matchesDB->configInfo();
$matchesDB->create([ 'id' => 1, 'home' => 0, 'guest' => 1, 'venue' => 'Stantiago Bernabeu' ]);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>body { font-family: Consolas, monospace;}</style>
</head>
<body>
    <h1>Some stuff happened with your database</h1>
    <article>
        <h4>Database connection</h4>
        <ul>
            <li><?php echo DatabaseConnection::printConfig(); ?></li>
        </ul>
    </article>
    <article>
        <h4>Database operations</h4>
        <ul>
            <?php foreach($GLOBALS['logs'] as $log): ?>
                <li><?php echo $log; ?></li>
            <?php endforeach; ?>
        </ul>
    </article>
</body>
</html>
