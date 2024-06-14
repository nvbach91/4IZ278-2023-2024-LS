<?php require_once __DIR__ . '/Database.php'; ?>
<?php
class LikesDB extends Database {
    protected $tableName = 'likes';

    // Like spot
    public function likeSpot($args) {
        $sql = "INSERT INTO $this->tableName (spot_id, user_id, date) VALUES (:spot_id, :user_id, :date)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'spot_id' => $args['spot_id'],
            'user_id' => $args['user_id'],
            'date' => $args['date']
        ]);
    }

    // Unlike spot
    public function unlikeSpot($spot_id, $user_id) {
        $sql = "DELETE FROM $this->tableName WHERE spot_id = $spot_id AND user_id = $user_id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
    }
}
?>