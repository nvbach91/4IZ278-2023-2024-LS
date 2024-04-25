<?php

require_once('includes/header.php');

if (isset($_GET['success']) && $_GET['success'] === 'true') {
  $action = isset($_GET['action']) ? $_GET['action'] : null;
  switch ($action) {
    case 'register':
      $message = "Registration successful";
      break;
    case 'login':
      $message = "Login successful";
      break;
    default:
      $message = "Success";
      break;
  }
}

?>
<?php if (isset($message)) : ?>
  <div class="p-2 m-2 bg-green text-white rounded-xl">
    <?php echo $message; ?>
  </div>
<?php endif; ?>
<?php require_once('includes/footer.php'); ?>