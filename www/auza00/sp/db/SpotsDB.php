<?php require_once __DIR__ . '/Database.php'; ?>
<?php
class SpotsDB extends Database
{
    protected $tableName = 'spots';

    // Add spot into database
    public function createSpot($args)
    {
        $sql = "INSERT INTO $this->tableName (user_id, username, title, description, coordinatesX, coordinatesY, category, image_id, created_at) VALUES (:user_id, :username, :title, :description, :coordinatesX, :coordinatesY, :category, :image_id, :created_at)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'user_id' => $args['user_id'],
            'username' => $args['user_username'],
            'title' => $args['title'],
            'description' => $args['description'],
            'coordinatesX' => $args['coordinatesX'],
            'coordinatesY' => $args['coordinatesY'],
            'category' => $args['category'],
            'image_id' => $args['image_id'],
            'created_at' => $args['created_at']
        ]);
    }
    // Delete spot from database
    public function deleteSpot($spot_id)
    {
        $sql = "DELETE FROM $this->tableName WHERE spot_id = $spot_id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
    }
}
?>