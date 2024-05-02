<?php

if (!isset($_GET['id'])) {
  header('Location: items.php');
  exit();
}

if (!isset($_SESSION)) {
  session_start();
}

require_once('db/user.php');
$db = new UsersDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $item = $db->getItem($_POST['id']);
  if ($_SESSION['last_updated_at'] !== $item['last_updated_at']) {
    header('Location: update-optimistic.php?error=conflict&id=' . $_POST['id'] . '&text=' . $_POST['text']);
  } else {
    $db->updateItem($_POST['id'], $_POST['text']);
    header('Location: items.php');
  }
  unset($_SESSION['last_updated_at']);
  unset($item);
  exit();
}

$item = $db->getItem($_GET['id']);
if (!isset($_SESSION['last_updated_at'])) {
  $_SESSION['last_updated_at'] = $item['last_updated_at'];
}

require_once('includes/admin_required.php');

require_once('includes/header.php');
?>

Optimistic update

<br />

The last_updated_at column is updated by a trigger in the DB.

<div class="flex flex-col gap-2 max-w-96 mt-4">
  <form method="post" class="contents">
    <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
    <?php if (isset($_GET['error']) && $_GET['error'] === 'conflict') : ?>
      <div class="p-2 bg-red text-white rounded-xl">Conflict</div>
    <?php endif; ?>

    <?php if (!isset($_GET['text'])) : ?>
      <textarea class="border p-2 h-32" type="text" name="text"><?php echo $item['text']; ?></textarea>
    <?php else : ?>
      <label for="text-original">Text stored in DB:</label>
      <textarea class="border p-2 h-32" type="text" name="text-original" id="text-original"><?php echo $item['text']; ?></textarea>
      <label for="text">Your text:</label>
      <textarea class="border p-2 h-32" type="text" name="text" id="text"><?php echo $_GET['text']; ?></textarea>
    <?php endif; ?>
    <button class="p-2 bg-green text-white rounded-xl" type="submit">Update</button>
  </form>
</div>

<?php

require_once('includes/footer.php');
