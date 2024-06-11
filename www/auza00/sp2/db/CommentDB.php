<?php require_once __DIR__ . '/Database.php'; ?>
<?php
class CommentDB extends Database {
    protected $tableName = 'comments';

    // Comment spot
    public function commentSpot($args) {
        $sql = "INSERT INTO $this->tableName (spot_id, user_id, username, date, text) VALUES (:spot_id, :user_id, :username, :date, :text)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'spot_id' => $args['spot_id'],
            'user_id' => $args['user_id'],
            'username' => $args['username'],
            'date' => $args['date'],
            'text' => $args['text']
        ]);
    }
}
?>