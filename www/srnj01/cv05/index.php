<?php

const DB_HOST = 'localhost';
const DB_NAME = 'starwars';
const DB_USER = 'root';
const DB_PASS = '';

function connect()
{
  return new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
}

function fetchTables()
{
  $pdo = connect();
  $stmt = $pdo->prepare('SHOW TABLES');
  $stmt->execute();
  return $stmt->fetchAll();
}

function fetchCharacters()
{
  $pdo = connect();
  $stmt = $pdo->prepare('SELECT * FROM characters');
  $stmt->execute();
  return $stmt->fetchAll();
}

function fetchCharacter($id)
{
  $pdo = connect();
  $stmt = $pdo->prepare('SELECT * FROM characters WHERE id = :id');
  $stmt->execute(['id' => $id]);
  return $stmt->fetch();
}

?>
<?php include('./includes/header.php') ?>

<div class="m-4 mx-auto w-fit">
  <h2 class="text-xl bold max-w-fit mb-4">Characters</h2>
  <?php foreach (fetchCharacters() as $character) : ?>
    <div class="flex items-center justify-between p-4 mb-4 bg-green-200">
      <div class="flex items-center">
        <img src="https://starwars-visualguide.com/assets/img/characters/<?php echo $character['character_id'] ?>.jpg" alt="<?php echo $character['name'] ?>" class="w-16 h-16 object-cover object-top rounded-full">
        <div class="ml-4">
          <h3 class="text-lg bold"><?php echo $character['name'] ?></h3>
          <p class="text-sm"><?php echo $character['age'] ?> years old</p>
        </div>
      </div>
      <a href="https://starwars-visualguide.com/#/characters/<?php echo $character['character_id'] ?>" target="_blank" rel="noopener noreferrer" class="ml-8 text-white
      bg-green rounded-full h-8 w-8 flex items-center justify-center">i</a>
    </div>
  <?php endforeach; ?>
</div>

<?php include('./includes/footer.php') ?>
<?php require('../hotreloader.php') ?>