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
    // Get comment id of specific comment
    public function getComment($args) {
        $sql = "SELECT comment_id FROM $this->tableName WHERE spot_id LIKE BINARY :spot_id AND user_id LIKE BINARY :user_id AND date LIKE BINARY :date LIMIT 1";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'spot_id' => $args['spot_id'],
            'user_id' => $args['user_id'],
            'date' => $args['date']
        ]);

        $comment_id = @$statement->fetchAll();
        return json_encode($comment_id);
    }
}
?>