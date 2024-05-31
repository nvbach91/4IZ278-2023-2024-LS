<?php

require_once '../db/database_class.php';
require_once '../utils/absolute-path.php';
session_start();

$booksDB = new BooksDB();
$usersDB = new UsersDB();
$ordersDB = new OrdersDB();
$bookOrdersDB = new BookOrdersDB();

if (empty($_SESSION['cart'])) {
  header("Location: /www/lacp06/sp/routes/index.php");
  exit();
}

if (isset($_COOKIE['name'])) {
  $user = $usersDB->findUser($_COOKIE['name']);
  $email = $user[0]['email'];
} else {
  $email = '';
}

if (isset($_POST['summary'])) {
  $final_price = 0;
  $_SESSION['final_price'] = 0;
  foreach ($_POST as $key => $value) {
    if (strpos($key, 'units_book') !== false) {
      $book_id = str_replace('units_book', '', $key);
      $units = $value;
      $book = $booksDB->findById($book_id);
      $book = $book[0];
      $book['units'] = $units;
      $books[] = $book;
      $_SESSION['final_books'] = $books;
      $final_price += ($book['price'] - ($book['price'] * $book['discount'] / 100)) * $units;
      $_SESSION['final_price'] = $final_price;
    }
  }
}
if (isset($_SESSION['final_books'])) {
  $books = $_SESSION['final_books'];
}

if (isset($_SESSION['final_price'])) {
  $final_price = $_SESSION['final_price'];
}

if (isset($_SESSION['errors'])) {
  $errors = $_SESSION['errors'];
  unset($_SESSION['errors']);
}

if (isset($_SESSION['confirmation']) && empty($errors)) {
  $confirmation = $_SESSION['confirmation'];
  unset($_SESSION['confirmation']);
}

?>

<?php require '../components/Header.php'; ?>
<div class="comic-container">
  <div class="comic-headline">
    <h1>Shrnutí</h1>
  </div>
  <div style="border-top: 3px solid grey;">
    <div class="comic-print">
      <div class="cart-container">
        <form action="<?php echo $absolutePath; ?>utils/send-mail.php" method="POST" style="display: flex; flex-direction: column; gap: 10px;">
          <?php if (!empty($errors)) : ?>
            <div class="alert alert-danger">
              <?php foreach ($errors as $error) : ?>
                <p><?php echo $error; ?></p>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
          <?php if (empty($errors) && isset($confirmation)) : ?>
            <div class="alert alert-success" role="alert">
              <p><?php echo $confirmation; ?></p>
            </div>
          <?php endif; ?>
          <p><b>Uživatelské údaje</b></p>
          <label for="email">* Email</label>
          <?php if (empty($email)) : ?>
            <input type="email" name="email" class="form-control">
          <?php else : ?>
            <input type="email" name="email_placeholder" class="form-control" value="<?php echo $email; ?>" disabled>
            <input type="hidden" name="email" class="form-control" value="<?php echo $email; ?>">
          <?php endif; ?>
          <label for="username">* Jméno a příjmení</label>
          <input type="text" name="full_name" class="form-control">
          <label for="address">* Adresa</label>
          <input type="text" name="address" class="form-control">
          <p><b>Položky</b></p>
          <div class="cart-final-items">
            <?php foreach ($books as $book) : ?>
              <div class="details">
                <p><b><?php echo $book['name']; ?></b> | <?php echo number_format($book['price'] - ($book['price'] * $book['discount'] / 100), 2, ',', ' '); ?> Kč</p>
                <p><?php echo $book['units']; ?> ks</p>
              </div>
            <?php endforeach; ?>
            <div class="details">
              <p><b>Celková cena:</b></p>
              <p style="font-size: 30px;"><?php echo number_format($final_price, 2, ',', ' '); ?> kč</p>
            </div>
          </div>
          <input type="hidden" name="pay" value="pay">
          <input type="hidden" name="final_price" value="<?php echo $final_price; ?>">
          <input type="hidden" name="items" value='<?php echo json_encode($books); ?>'>
          <button type="submit" class="btn btn-danger">Zaplatit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php require '../components/Footer.php'; ?>