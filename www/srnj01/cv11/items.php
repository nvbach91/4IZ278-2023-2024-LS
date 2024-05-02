<?php

require_once('includes/admin_required.php');

require_once('includes/header.php');

require_once('db/user.php');

$db = new UsersDB();

$items = $db->getItems();

?>

Items

<?php if (isset($_GET['error']) && $_GET['error'] === 'locked') : ?>
  <div class="p-2 bg-red text-white rounded-xl mt-4">Someone else is editting this item!</div>
<?php endif; ?>
<div class="grid grid-cols-[auto_1fr_auto_auto] mt-4 border">
  <?php foreach ($items as $item) : ?>
    <div class="border p-2"><?php echo $item['id']; ?></div>
    <div class="border p-2"><?php echo $item['text']; ?></div>
    <div class="border p-2 grid items-center"><a class="p-2 bg-green text-white rounded-xl" href="update-optimistic.php?id=<?php echo $item['id']; ?>">Optimistic</a></div>
    <div class="border p-2 grid items-center"><a class="p-2 bg-green text-white rounded-xl" href="update-pessimistic.php?id=<?php echo $item['id']; ?>">Pessimistic</a></div>
  <?php endforeach; ?>
</div>

<?php

require_once('includes/footer.php');
