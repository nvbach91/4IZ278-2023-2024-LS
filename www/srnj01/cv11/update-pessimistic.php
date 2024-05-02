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

$item = $db->getItem($_GET['id']);
if ($item === null) {
  header('Location: items.php');
  exit();
}
if ($item['locked_at'] !== null && new DateTime($item['locked_at']) > new DateTime('-5 minutes') && $item['locked_by'] !== $_SESSION['id']) {
  header('Location: items.php?error=locked');
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $db->pessimisticUpdate($_POST['id'], $_POST['text']);
  header('Location: items.php');
  exit();
}

$db->pessimisticUpdateStart($item['id'], $_SESSION['id']);

require_once('includes/admin_required.php');

require_once('includes/header.php');

?>

Pessimistic update

<div class="flex flex-col gap-2 max-w-96 mt-4">
  <form method="post" class="contents">
    <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
    <textarea class="border p-2 h-32" type="text" name="text"><?php echo $item['text']; ?></textarea>
    <button class="p-2 bg-green text-white rounded-xl" type="submit">Update</button>
  </form>
</div>

<?php

require_once('includes/footer.php');
