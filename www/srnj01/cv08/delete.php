<?php

if (isset($_GET['id'])) {
  require_once('db/eshop.php');
  $db = new ProductsDB();
  $db->delete($_GET['id']);
  header('Location: index.php?success=true');
} else {
  header('Location: index.php');
}
