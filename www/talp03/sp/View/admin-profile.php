<?php 

require_once '../Controller/entryPrivilege.php';

?>

<?php include './includes/head.php'; ?>
<body>
    <?php require './includes/navbar.php'; ?>
    <div class="container">
        <ul class="category-list">
            <li class="category">
                <a href="orders.php">Orders</a>
            </li>
            <li class="category">
                <a href="wishlist.php">Wishlist</a>
            </li>
            <li class="category">
                <a href="user-privileges.php">Users priviliges</a>
            </li>
            <li class="category">
                <a href="user-orders.php">Manage user orders</a>
            </li>
        </ul>
    </div>
    <?php include './includes/footer.php'; ?>
</body>
</html>