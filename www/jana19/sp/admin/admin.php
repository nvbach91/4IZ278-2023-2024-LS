<?php 
// require __DIR__ . '/../includes/userRequired.php';
require __DIR__ . '/../includes/adminHeader.php'; 

?>


<main class="container">
    <h1 class="my-4">Administration</h1>

    <div class="row">
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="card-title"><a href="./users.php">Users</a></h2>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="card-title"><a href="./productsNew.php">Add a new Product</a></h2>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="card-title"><a href="./productTypes.php">Product Types</a></h2>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="card-title"><a href="./orders.php">Orders</a></h2>
                </div>
            </div>
        </div>
    </div>

</main>


<?php require __DIR__ . '/../includes/footer.php'; ?>