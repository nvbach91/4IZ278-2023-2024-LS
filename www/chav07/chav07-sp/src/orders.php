<?php

use Vilem\BookBookGo\database\OrderRepository;

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/authentication/AuthUtils.php";
require_once __DIR__ . "/database/OrderRepository.php";
require_once __DIR__ . "/config.php";
//session_start();
startSessionIfNone();

if (!isAuthenticated()){
    header("HTTP/1.1 401 Unauthorized");
    header("Location: " . htmlspecialchars(BASE_URL . "/login.php"));
    exit(401);
}

if (!isAuthorized(AuthRole::Admin)){
    header("HTTP/1.1 403 Forbidden");
    exit(403);
}

$repo = new OrderRepository();
$orderCount = $repo->getOrderCount();
$pageCount = ceil($orderCount / ITEMS_PER_PAGE);
$currentPage = 0;
if (isset($_GET["page"])){
    $currentPage =  filter_var(htmlspecialchars(strip_tags($_GET["page"])), FILTER_SANITIZE_NUMBER_INT);
}

$orders = $repo->getOrders($currentPage);



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./favicon.ico">
    <link rel="stylesheet" type="text/css" href="./../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/main.css">
    <title>BookBookGo - Orders</title>
</head>
<body>

<div class="d-flex flex-column full-height">
    <?php require './requires/navigation.php'; ?>

    <main  class="px-4 container navbar-spacing">
        <section class="row border-bottom mb-2">
            <div class="col-2 fw-bold">
                ID
            </div>
            <div class="col-2 fw-bold">
                User ID
            </div>
            <div class="col-1 fw-bold">
                Paid
            </div>
            <div class="col-1 fw-bold">
                Delivered
            </div>
            <div class="col-6 text-center fw-bold">
                Actions
            </div>
        </section>
        <?php foreach ($orders as $order): ?>
            <section class="row mb-2 border-bottom">
                <div class="col-2">
                    <?php echo htmlspecialchars($order->id);?>
                </div>
                <div class="col-2">
                    <?php echo htmlspecialchars($order->userId);?>
                </div>
                <div class="col-1 <?php echo htmlspecialchars( $order->paid ? "text-success" : "text-danger" );?>">
                    <?php echo htmlspecialchars( $order->paid ? "yes" : "no" );?>
                </div>
                <div class="col-1 <?php echo htmlspecialchars( $order->delivered ? "text-success" : "text-danger" );?>">
                    <?php echo htmlspecialchars( $order->delivered ? "yes" : "no" );?>
                </div>
                <div class="col-6 text-end d-flex flex-row justify-content-end">
                    <?php if ($order->paid): ?>
                        <a class=" btn btn-outline-danger mb-2 me-1" href="<?php echo htmlspecialchars(BASE_URL . "/orders/notpaid.php?id=" . $order->id)?>">Not Paid</a>
                    <?php else: ?>
                        <a class=" btn btn-outline-primary mb-2 me-1" href="<?php echo htmlspecialchars(BASE_URL . "/orders/paid.php?id=" . $order->id)?>">Paid</a>
                    <?php endif; ?>

                    <?php if ($order->delivered): ?>
                        <a class=" btn btn-outline-danger mb-2" href="<?php echo htmlspecialchars(BASE_URL . "/orders/notdelivered.php?id=" . $order->id)?>">Not Delivered</a>
                    <?php else: ?>
                        <a class=" btn btn-outline-primary mb-2 me-1" href="<?php echo htmlspecialchars(BASE_URL . "/orders/delivered.php?id=" . $order->id)?>">Delivered</a>
                    <?php endif; ?>

                </div>

            </section>

        <?php endforeach; ?>


        <!--            pagination-->
        <div class="row">
            <div class="col-12">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item <?php echo ($currentPage > 0 ? "" : "disabled" ); ?>" >
                            <a class="page-link" href="<?php echo ($currentPage > 0 ? htmlspecialchars(BASE_URL . "/orders.php?page=" . $currentPage - 1) : "" ); ?>">
                                Previous
                            </a>
                        </li>
                        <?php for ($i = 0; $i < $pageCount; $i++): ?>
                            <li class="page-item <?php echo ($i == $currentPage ? "active" : ""); ?>"><a class="page-link" href="<?php echo htmlspecialchars(BASE_URL. "/orders.php?page=" . $i) ?>"><?php echo htmlspecialchars($i + 1) ?></a></li>
                        <?php endfor; ?>
                        <li class="page-item <?php echo ($currentPage < $pageCount - 1 ? "" : "disabled" ); ?>" >
                            <a class="page-link" href="<?php echo ($currentPage < $pageCount - 1 ? htmlspecialchars(BASE_URL . "/orders.php?page=" . $currentPage + 1) : "" ); ?>">
                                Next
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

    </main>
    <?php include __DIR__ . "/includes/footer.php";?>
    <script src="./../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
