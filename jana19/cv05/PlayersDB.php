<?php
require_once './DatabaseClass.php';
// pochopila jsem to tak, že ty konkrétní SQL dotazy budou pro každou z těch 3 tříd zvlášť, protože budou pracovat s jinými tabulkami
// respektvie, odhaduj, že přes nějaké proměnné s názvy tabulek apod. + appendy by to asi šlo udělat i dynamicky,
// ale vzhledem k tomu, že na CV jsme si ukázali příklad, že se ten SQL dotaz vloží do metody uvnitř třídy PlayersDB, tak předpokládám, že by to nebyla ta správná cesta.

class PlayersDB extends Database
{
    public function create($data)
    {
        // $statement = $this->pdo->prepare('INSERT INTO players ...');
        // $statement->execute();

        // pro domácí úkol jenom nechat vypsat text
        // třídy rozdělit do souborů
        echo 'Players DB called method create';

        return $this->runQuery(
            'INSERT INTO players(name) VALUES(:name);',
            ['name' => $data['name']]
        );
        // a něco podobnýho i pro ty ostatní

    }
    public function find($query)
    {
        echo 'Players DB called method find';

        $statement = $this->pdo->prepare("
            SELECT * FROM players WHERE name = :name;
        ");
        $statement->execute([
            'name' => $query['name']
        ]);
        $results = $statement->fetchAll();
        var_dump($results);
    }

    public function findALL($query)
    {
        echo 'Players DB called method find';
        return $this->runQuery(
            'SELECT * FROM players;',
            []
        );
    }

    public function update($query, $data)
    {
        echo 'Players DB called method update';
    }
    public function delete($query)
    {
        echo 'Players DB called method delete';

        $statement = $this->pdo->prepare("
            DELETE FROM players WHERE name = :name;
        ");
        $statement->execute([
            'name' => $query['name']
        ]);
    }
    
}
// class TeamsDB extends Database {}
// class MatchesDB extends Database {}

// $playersDB = new PlayersDB();
// $playersDB->create([]);
// $playersDB->find([]);
// $playersDB->update([], []);
// $playersDB->delete([]);

// $pdoConnection = DatabaseConnection::getPDOConnection();
