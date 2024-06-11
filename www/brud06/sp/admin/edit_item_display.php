<?php
session_start();
require_once '../restrictions/admin_required.php';
require_once '../db/ItemsDB.php';
$itemsDB = new ItemsDB();

if (isset($_SESSION['success_message']) && !empty($_SESSION['success_message'])) {
    echo $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

$itemsPerPage = 6;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $itemsPerPage;

$items = $itemsDB->findAll($itemsPerPage, $offset);
$totalItems = $itemsDB->getTotalCount();
$totalPages = ceil($totalItems / $itemsPerPage);

include '../includes/admin_head.php';
?>

<div class="container">
    <div class="row">
        <?php foreach ($items as $item) : ?>
            <div class="col-md-4">
                <div class="card h-100">
                    <img class="card-img-top" src="../<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $item['name']; ?></h5>
                    </div>
                    <div class="card-footer">
                        <a class="btn" href="../store_item_id_admin.php?item_id=<?php echo $item['item_id']; ?>">Edit</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>
<a href="admin_interface.php" class="btn btn-primary">Back</a>
<?php
include '../includes/foot.php';
