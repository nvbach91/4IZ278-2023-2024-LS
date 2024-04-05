<?php
// setcookie('myfirstcookie', 'pokemon pikachu', time() + 20);
// session_start();

// $_SESSION['mypokemon'] = 'bulbasaur';
// var_dump($_SESSION);
?>

<?php
// class ProductDB extends Database {
//     public function countAllProducts() {
//         # celkovy pocet zbozi pro strankovani
//         $count = $this->$pdo->query("SELECT COUNT(id) FROM cv08_goods")->fetchColumn();
//         return $count;
//     }
//     public function findItemsPage($offset, $nItemsPerPagination) {
//         $stmt = $this->$pdo->prepare("SELECT * FROM cv08_goods ORDER BY id DESC LIMIT $nItemsPerPagination OFFSET ?");
//         $stmt->bindValue(1, $offset, PDO::PARAM_INT);
//         $stmt->execute();
//         return $stmt->fetchAll();
//     }
// }
?>
<?php 
                       // 0 1     2     3   4    5           6           7
$items = explode(' ', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Error in voluptatum molestias velit quam pariatur quasi magnam numquam deserunt eos cupiditate, nemo placeat rem beatae esse ea tempora explicabo consectetur?');
$nItems = count($items);
$nItemsPerPagination = 7;
$nPaginations = ceil($nItems / $nItemsPerPagination);
$nItemsOnLastPagination = $nItems % $nItemsPerPagination;
$displayItems = [];
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    $offset = ($page - 1) * $nItemsPerPagination;
    $displayItems = array_splice($items, $offset, $nItemsPerPagination);
    // $displayItems = $productsDB->findItemsPage($offset, $displayItems);
}
?>
<div>pocet produktu: <?php echo $nItems; ?></div>
<div>pocet strankovani: <?php echo $nPaginations; ?></div>
<div>pocet produktu na posledni strance: <?php echo $nItemsOnLastPagination; ?></div>
<div>
    <?php for($i = 0; $i < $nPaginations; $i++) { ?>
        <a href="?page=<?php echo $i + 1; ?>"><?php echo $i + 1; ?></a>
    <?php } ?>
</div>
<ul>
    <?php foreach($displayItems as $item):?>
        <li><?php echo $item; ?></li>
    <?php endforeach; ?>
<ul>
