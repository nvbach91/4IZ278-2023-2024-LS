<?php

require_once '../db/database_class.php';
require_once '../utils/manager-check.php';
session_start();

$action = $_SERVER['PHP_SELF'];

$booksDB = new BooksDB();
$worldsDB = new WorldsDB();
$worlds = $worldsDB->findAll();
$publishersDB = new PublishersDB();
$publishers = $publishersDB->findAll();
$genresDB = new GenresDB();
$genres = $genresDB->findAll();

if (isset($_GET['book_id'])) {
  $_SESSION['admin_book']['book_id'] = $_GET['book_id'];
  $timestamp = date('Y-m-d H:i:s');
  $_SESSION['book_timestamp'] = $timestamp;
  $booksDB->updateTimestamp($_SESSION['admin_book']['book_id'], $timestamp);

  $book = $booksDB->findById($_SESSION['admin_book']['book_id']);
  $_SESSION['admin_book']['name'] = $book[0]['name'];
  $_SESSION['admin_book']['author'] = $book[0]['author'];
  $_SESSION['admin_book']['price'] = $book[0]['price'];
  $_SESSION['admin_book']['discount'] = $book[0]['discount'];
  $_SESSION['admin_book']['language'] = $book[0]['language'];
  $_SESSION['admin_book']['rating'] = $book[0]['rating'];
  $_SESSION['admin_book']['units'] = $book[0]['units'];
  $_SESSION['admin_book']['pages'] = $book[0]['pages'];
  $_SESSION['admin_book']['image'] = $book[0]['image'];
  $_SESSION['admin_book']['publish_date'] = $book[0]['publish_date'];
  $_SESSION['admin_book']['description'] = $book[0]['description'];
  $_SESSION['admin_book']['genre'] = $book[0]['genre_id'];
  $_SESSION['admin_book']['publisher'] = $book[0]['publisher_id'];
  $_SESSION['admin_book']['world'] = $book[0]['world_id'];
}

if (!empty($_POST)) {
  $name = htmlspecialchars(trim($_POST['name']));
  $_SESSION['admin_book']['name'] = $name;
  $author = htmlspecialchars(trim($_POST['author']));
  $_SESSION['admin_book']['author'] = $author;
  $price = htmlspecialchars(trim($_POST['price']));
  $_SESSION['admin_book']['price'] = $price;
  $discount = htmlspecialchars(trim($_POST['discount']));
  $_SESSION['admin_book']['discount'] = $discount;
  $language = htmlspecialchars(trim($_POST['language']));
  $_SESSION['admin_book']['language'] = $language;
  $rating = htmlspecialchars(trim($_POST['rating']));
  $_SESSION['admin_book']['rating'] = $rating;
  $units = htmlspecialchars(trim($_POST['units']));
  $_SESSION['admin_book']['units'] = $units;
  $pages = htmlspecialchars(trim($_POST['pages']));
  $_SESSION['admin_book']['pages'] = $pages;
  $image = htmlspecialchars(trim($_POST['image']));
  $_SESSION['admin_book']['image'] = $image;
  $publish_date = htmlspecialchars(trim($_POST['publish_date']));
  $_SESSION['admin_book']['publish_date'] = $publish_date;
  $description = htmlspecialchars(trim($_POST['description']));
  $_SESSION['admin_book']['description'] = $description;
  $genre_id = $_POST['genre'];
  $_SESSION['admin_book']['genre'] = $genre_id;
  $publisher_id = $_POST['publisher'];
  $_SESSION['admin_book']['publisher'] = $publisher_id;
  $world_id = $_POST['world'];
  $_SESSION['admin_book']['world'] = $world_id;

  $errors = [];

  if (strlen($name) < 3) {
    empty($name) ? $name_check = "Název je povinný!" : $name_check = "Název musí být alespoň 3 znaky!";
    array_push($errors, $name_check);
  }
  if (strlen($author) < 3) {
    empty($author) ? $author_check = "Autor je povinný!" : $author_check = "Autor musí být alespoň 3 znaky!";
    array_push($errors, $author_check);
  }
  if (!is_numeric($price)) {
    empty($price) ? $price_check = "Cena je povinná!" : $price_check = $price . " není validní cena!";
    array_push($errors, $price_check);
  }
  if (empty($discount)) {
    $discount = 0;
  }
  if (strlen($language) < 3) {
    empty($language) ? $language_check = "Jazyk je povinný!" : $language_check = "Jazyk musí být alespoň 3 znaky!";
    array_push($errors, $language_check);
  }
  if (!is_numeric($rating)) {
    empty($rating) ? $rating_check = "Hodnocení je povinné!" : $rating_check = $rating . " není validní hodnocení!";
    array_push($errors, $rating_check);
  }
  if (!is_numeric($units)) {
    empty($units) ? $units_check = "Počet kusů je povinný!" : $units_check = $units . " není validní počet kusů!";
    array_push($errors, $units_check);
  }
  if (!is_numeric($pages)) {
    empty($pages) ? $pages_check = "Počet stran je povinný!" : $pages_check = $pages . " není validní počet stran!";
    array_push($errors, $pages_check);
  }
  if (strlen($image) < 3) {
    empty($image) ? $image_check = "URL obrázku je povinné!" : $image_check = "URL obrázku musí být alespoň 3 znaky!";
    array_push($errors, $image_check);
  }
  if (empty($publish_date)) {
    $publish_date_check = "Datum vydání je povinné!";
    array_push($errors, $publish_date_check);
  }
  if (strlen($description) < 10) {
    empty($description) ? $description_check = "Popis je povinný!" : $description_check = "Popis musí být alespoň 10 znaků!";
    array_push($errors, $description_check);
  }
  if ($genre_id == "žánr") {
    array_push($errors, "Žánr je povinný!");
  }
  if ($publisher_id == "nakladatelství") {
    array_push($errors, "Nakladatelství je povinné!");
  }
  if ($world_id == "svět") {
    array_push($errors, "Svět je povinný!");
  }
  if (count($errors) == 0) {
    $book = $booksDB->findById($_SESSION['admin_book']['book_id']);
    if ($book[0]['last_update'] === $_SESSION['book_timestamp']) {
      $successMessage = "Kniha upravena!";
      $booksDB->updateBook($book[0]['id'], $name, $author, $price, $discount, $units, $publish_date, $language, $image, $description, $pages, $rating, $publisher_id, $genre_id, $world_id);
      $booksDB->updateTimestamp($book[0]['id'], date('0000-00-00 00:00:00'));
    } else {
      array_push($errors, "Kniha je již upravována, uložte svou práci před zavřením této stránky!");
    }
  }
}

if (isset($_SESSION['admin_book'])) {
  $saved_name = $_SESSION['admin_book']['name'];
  $saved_author = $_SESSION['admin_book']['author'];
  $saved_price = $_SESSION['admin_book']['price'];
  $saved_discount = $_SESSION['admin_book']['discount'];
  $saved_language = $_SESSION['admin_book']['language'];
  $saved_rating = $_SESSION['admin_book']['rating'];
  $saved_units = $_SESSION['admin_book']['units'];
  $saved_pages = $_SESSION['admin_book']['pages'];
  $saved_image = $_SESSION['admin_book']['image'];
  $saved_publish_date = $_SESSION['admin_book']['publish_date'];
  $saved_description = $_SESSION['admin_book']['description'];
  $saved_genre = $_SESSION['admin_book']['genre'];
  $saved_publisher = $_SESSION['admin_book']['publisher'];
  $saved_world = $_SESSION['admin_book']['world'];
} else {
  $saved_name = "";
  $saved_author = "";
  $saved_price = "";
  $saved_discount = "";
  $saved_language = "";
  $saved_rating = "";
  $saved_units = "";
  $saved_pages = "";
  $saved_image = "";
  $saved_publish_date = "";
  $saved_description = "";
  $saved_genre = "";
  $saved_publisher = "";
  $saved_world = "";
}

?>

<?php require_once '../components/Header.php'; ?>
<div class="container">
  <form class="comic-login" action="<?php echo $action ?>" method="POST">
    <?php if (!empty($errors)) : ?>
      <div class="alert alert-danger">
        <?php foreach ($errors as $error) : ?>
          <p><?php echo $error; ?></p>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
    <?php if (isset($successMessage)) : ?>
      <div class="alert alert-success" role="alert">
        <p><?php echo $successMessage; ?></p>
      </div>
    <?php endif; ?>
    <label for="name">* Název</label>
    <input type="text" name="name" class="form-control" value="<?php echo $saved_name; ?>">
    <label for="author">* Autor</label>
    <input type="text" name="author" class="form-control" value="<?php echo $saved_author; ?>">
    <label for="price">* Cena</label>
    <input type="number" name="price" class="form-control" min="0" step="0.01" value="<?php echo $saved_price; ?>">
    <label for="discount">Sleva (%)</label>
    <input type="number" name="discount" class="form-control" min="0" max="100" step="0.01" value="<?php echo $saved_discount; ?>">
    <label for="language">* Jazyk</label>
    <input type="text" name="language" class="form-control" value="<?php echo $saved_language; ?>">
    <label for="rating">* Hodnocení (0 - 5)</label>
    <input type="number" name="rating" class="form-control" min="1" max="5" step="1" value="<?php echo $saved_rating; ?>">
    <label for="units">* Počet kusů</label>
    <input type="number" name="units" class="form-control" min="1" value="<?php echo $saved_units; ?>">
    <label for="pages">* Počet stran</label>
    <input type="number" name="pages" class="form-control" min="1" value="<?php echo $saved_pages; ?>">
    <label for="image">* URL Obrázku</label>
    <input type="text" name="image" class="form-control" value="<?php echo $saved_image; ?>">
    <label for="publish_date">* Datum vydání</label>
    <input type="date" name="publish_date" class="form-control" value="<?php echo $saved_publish_date; ?>">
    <label for="description">* Popis</label>
    <textarea name="description" class="form-control"><?php echo $saved_description; ?></textarea>
    <label for="world">* Svět</label>
    <select name="world" class="form-control">
      <option value="svět">Svět</option>
      <?php foreach ($worlds as $world) : ?>
        <option value="<?php echo $world['id']; ?>" <?php echo $saved_world == $world['id'] ? 'selected' : ''; ?>>
          <?php echo $world['name']; ?>
        </option>
      <?php endforeach; ?>
    </select>
    <label for="publisher">* Nakladatelství</label>
    <select name="publisher" class="form-control">
      <option value="nakladatelství">Nakladatelství</option>
      <?php foreach ($publishers as $publisher) : ?>
        <option value="<?php echo $publisher['id']; ?>" <?php echo $saved_publisher == $publisher['id'] ? 'selected' : ''; ?>>
          <?php echo $publisher['name']; ?>
        </option>
      <?php endforeach; ?>
    </select>
    <label for="genre">* Žánr</label>
    <select name="genre" class="form-control">
      <option value="žánr">Žánr</option>
      <?php foreach ($genres as $genre) : ?>
        <option value="<?php echo $genre['id']; ?>" <?php echo $saved_genre == $genre['id'] ? 'selected' : ''; ?>>
          <?php echo $genre['name']; ?>
        </option>
      <?php endforeach; ?>
    </select>
    <button type="submit" class="btn btn-danger">Upravit</button>
  </form>
</div>
<?php require_once '../components/Footer.php'; ?>