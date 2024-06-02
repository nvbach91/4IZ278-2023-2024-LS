<?php
include_once '../controller/db.php';
include '../model/Tags.php';

class TagsDB extends Database {
    public function __construct() {
        self::getInstance();
        $this->tableName = 'sp_tags';
    }
    public function create($tag) 
    {
        $statement = self::$DB->prepare('INSERT INTO '.$this->tableName.' (tag, color, priority, home_id) 
        VALUES (:tag, :color, :priority, :home_id)');
        $statement->bindValue(':tag', $tag->tag);
        $statement->bindValue(':color', $tag->color);
        $statement->bindValue(':priority', $tag->priority);
        $statement->bindValue(':home_id', $tag->home_id);
        $statement->execute();
    }

    public function update($tag, $id) 
    {
        $statement = self::$DB->prepare('UPDATE '.$this->tableName.' SET tag = :tag, color = :color, priority = :priority, home_id = :home_id WHERE id = :id');
        $statement->bindValue(':id', $id);
        $statement->bindValue(':tag', $tag->tag);
        $statement->bindValue(':color', $tag->color);
        $statement->bindValue(':priority', $tag->priority);
        $statement->bindValue(':home_id', $tag->home_id);
        $statement->execute();
    }
public function readAll()
    {
        $statement = self::$DB->prepare('SELECT * FROM '.$this->tableName.' ORDER BY priority DESC');
        $statement->execute();
        $res = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }

}
