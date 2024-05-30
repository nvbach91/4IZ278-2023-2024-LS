<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../vendor/autoload.php';
require_once '../db/database_class.php';

$booksDB = new BooksDB();
$usersDB = new UsersDB();
$ordersDB = new OrdersDB();
$bookOrdersDB = new BookOrdersDB();

session_start();

$mail = new PHPMailer(true);

if (isset($_POST['pay'])) {
  $email = htmlspecialchars(trim($_POST['email']));
  $full_name = htmlspecialchars(trim($_POST['full_name']));
  $address = htmlspecialchars(trim($_POST['address']));
  $final_price = $_POST['final_price'];
  $books = json_decode($_POST['items'], true);
  $timestamp = date('Y-m-d H:i:s');

  $errors = [];

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    empty($email) ? $email_check = "Email je povinný!" : $email_check = $email . " není validní emailová adresa!";
    array_push($errors, $email_check);
  }

  if (strlen($full_name) < 3) {
    array_push($errors, "Jméno a příjmení je povinné!");
  }

  if (strlen($address) < 3) {
    array_push($errors, "Adresa je povinná!");
  }

  if (count($errors) == 0) {
    $successMessage = "Objednávka byla úspěšně odeslána!";

    unset($_SESSION['cart']);
    $user = $usersDB->findUser($email);
    $user_id = $user[0]['id'];
    $ordersDB->create($user_id, $timestamp, $final_price, 'Zaplaceno');
    $latestOrder = $ordersDB->findLatest()[0]['id'];
    foreach ($books as $book) {
      $bookOrdersDB->create($latestOrder, $book['id'], $book['units'], $book['price'] - ($book['price'] * $book['discount'] / 100));
      $_SESSION['confirmation'] = 'Objednávka byla úspěšně odeslána!';
    }

    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'paja.lacina@gmail.com';
    $mail->Password   = '';
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->CharSet = 'UTF-8';

    //Recipients
    $mail->setFrom('paja.lacina@gmail.com', 'Comic Central');
    $mail->addAddress($email, $full_name);

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Comic Central - Objednávka';
    $mail->Body    = '
      <h1>Objednávka z Comic Central</h1>
      <p>Dobrý den ' . $full_name . '. Zde vám posíláme shrnutí vaší objednávky:</p>
      <p><b>Číslo objednávky:</b> ' . $latestOrder . '</p>
      <p><b>Uživatelské údaje</b></p>
      <p>Email: ' . $email . '</p>
      <p>Jméno a příjmení: ' . $full_name . '</p>
      <p>Adresa: ' . $address . '</p>
      <p><b>Položky</b></p>';
    foreach ($books as $book) {
      $mail->Body .= '
          <p><b>' . $book['name'] . '</b> | ' . number_format($book['price'] - ($book['price'] * $book['discount'] / 100), 2, ',', ' ') . ' Kč</p>
          <p>' . $book['units'] . ' ks</p>
        ';
    }
    $mail->Body .= '
      <p><b>Celková cena:</b></p>
      <p style="font-size: 30px;">' . number_format($final_price, 2, ',', ' ') . ' kč</p>
      <p>Děkujeme za vaši objednávku!</p>
      ';

    $mail->send();
    header("Location: /www/lacp06/sp/routes/cart.php");
  } else {
    $_SESSION['errors'] = $errors;
    header("Location: /www/lacp06/sp/routes/cart_final.php");
  }
}
