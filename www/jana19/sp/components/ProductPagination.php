<?php
require_once __DIR__ . '/../db/ProductsDatabase.php';

$currentUrlParams = $_SERVER['QUERY_STRING'];
$productsDB = new ProductsDatabase();

$nItemsPerPagination = 2;

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $nItemsPerPagination;


$urlParamsArr = explode("&", $currentUrlParams);

$productTypeId = 0;
for($i = 0; $i < count($urlParamsArr); $i++){
    if(str_contains($urlParamsArr[$i], 'productType')){
        $productTypeId = explode('=',$urlParamsArr[$i])[1];
    }
}

if(count($urlParamsArr) == 1 && $urlParamsArr[0] == "" ) {
    $nItems = $productsDB->readCountAllProducts();

}
else if (count($urlParamsArr) > 1 || (count($urlParamsArr) == 1 && $urlParamsArr[0] != " " )) {
    $nItems = $productsDB->readCountProcutsByQuerryString($urlParamsArr);

} 

$nPaginations = ceil($nItems / $nItemsPerPagination);
$nItemsOnLastPagination = $nItems % $nItemsPerPagination;

for($i = 0; $i < count($urlParamsArr); $i++){
    if(str_contains($urlParamsArr[$i], 'productType')){
        $productTypeId = explode('=',$urlParamsArr[$i])[1];
    }
}

if(count($urlParamsArr) == 1 && $urlParamsArr[0] == "" ) {
    $iems = $productsDB->readAllProductsPage($offset, $nItemsPerPagination);

}
else if (count($urlParamsArr) > 1 || (count($urlParamsArr) == 1 && $urlParamsArr[0] != " " )) {
    $items = $productsDB->readProcutsByQuerryStringPage($urlParamsArr, $offset, $nItemsPerPagination);

} 


?>

<div class="pagination">
    <?php for ($i = 0; $i < $nPaginations; $i++) { ?>
        <a href="?page=<?php echo $i + 1; ?>"><?php echo $i + 1; ?></a> <!-- i+1 bay to nezačínalo od nuly -->
    <?php } ?>
</div>