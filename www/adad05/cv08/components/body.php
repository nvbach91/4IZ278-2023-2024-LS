    <?php

    require 'classes/GoodsDB.php';

    $goodsDB = new GoodsDB();
    $nItems = $goodsDB->getNumberOfEntries()[0]["COUNT(good_id)"];
    $nItemsPerPagination = 5;
    $nPaginations = ceil($nItems / $nItemsPerPagination);
    $nItemsOnLastPagination = $nItems % $nItemsPerPagination;

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        $offset = ($page - 1) * $nItemsPerPagination;
        $displayItems = $goodsDB->getEntriesForPage($nItemsPerPagination, $offset);
    } else {
        $displayItems = $goodsDB->getEntriesForPage($nItemsPerPagination, 0);
    }

    ?>

    <div class="container container-products-margin">
        <a class="page-ref create-new-button" href="create-item.php">Create new product</a>
    </div>

    <!-- Page Content-->
    <div class="container container-products-margin">
        <div class="row">
            <div class="col-lg-9">
                <div class="row">
                    <?php foreach ($displayItems as $item) : ?>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100">
                                <img class="card-img-top" src="<?php echo $item['img']; ?>" alt="...">
                                <div class="card-body">
                                    <h4 class="card-title"><a href="#!"><?php echo $item['good_id'] . ' ';
                                                                        echo $item['name']; ?></a></h4>
                                    <h5><?php echo $item['price']; ?> Kč</h5>
                                    <p class="card-text"><?php echo $item['description']; ?></p>
                                    <div>
                                        <a class="page-ref" href="buy.php?id=<?php echo $item['good_id']; ?>">Buy</a>
                                        <a class="page-ref" href="edit-item.php?id=<?php echo $item['good_id']; ?>">Edit</a>
                                        <a class="page-ref" href="delete-item.php?id=<?php echo $item['good_id']; ?>">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container container-ref-page">
        <?php for ($i = 0; $i < $nPaginations; $i++) { ?>
            <a class="page-ref" href="?page=<?php echo $i + 1; ?>"><?php echo $i + 1; ?></a>
        <?php } ?>
    </div>