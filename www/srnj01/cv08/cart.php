<?php
if (!isset($_SESSION)) {
  session_start();
}
if (isset($_GET['action']) && isset($_GET['id'])) {
  if ($_GET['action'] == 'add') {
    if (!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = [];
    }
    if (!in_array($_GET['id'], $_SESSION['cart'])) {
      array_push($_SESSION['cart'], $_GET['id']);
    }
  } else if ($_GET['action'] == 'remove') {
    $index = array_search($_GET['id'], $_SESSION['cart']);
    if ($index !== false) {
      unset($_SESSION['cart'][$index]);
    }
  }
  header('Location: cart.php');
}

require_once('db/eshop.php');

if (isset($_SESSION['cart']) && $_SESSION['cart'] != null && count($_SESSION['cart']) > 0) {
  $db = new ProductsDB();
  $products = $db->findByIds($_SESSION['cart']);
}

include('includes/header.php');
?>

<div class="row">
  <div class="col-lg-12">
    <?php
    if (!isset($products) || $products == null || count($products) == 0) {
      echo '<h1 class="my-4">Your cart is empty!</h1>
      <p>Go back to the <a href="index.php">shop</a> and add some products to your cart.</p>';
    } else {
      echo '<h1 class="my-4">Your cart</h1>
      <table class="table">
        <thead>
          <tr>
            <th scope="col" class="col-lg-4">Product</th>
            <th scope="col">Price</th>
            <th class="col-sm-4"></th>
          </tr>
        </thead>
        <tbody>';
      $total = 0;
      foreach ($products as $product) {
        echo '<tr>
          <td>' . $product['name'] . '</td>
          <td>' . $product['price'] . '</td>
          <td>
            <a href="cart.php?action=remove&id=' . $product['good_id'] . '" class="btn btn-danger d-flex align-items-center w-4">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
            </a>
          </td>
        </tr>';
        $total += $product['price'];
      }
      echo '<tr>
        <td><strong>Total</strong></td>
        <td><strong>' . $total . '</strong></td>
        <td></td>
      </tr>
      </tbody>
      </table>';
    }
    ?>
  </div>
</div>

<?php
include('includes/footer.php');
?>