<?php
require_once __DIR__ . '/../db/ProductsDB.php';
require_once __DIR__ . '/pagination.php';

// vyzkousime zobrazeni komponenty pomoci statickych dat v kodu (mock)
// $products = [
//    ['product_id' => 1, 'name' => 'Tommy Atkins', 'price' => '49.90', 'img' => 'https://github.com/nvbach91/nvbach91/assets/20724910/1983948a-b927-4235-b0bf-adb9a11abcbd'],
//    ['product_id' => 2, 'name' => 'Ataulfo',      'price' => '60.90', 'img' => 'https://github.com/nvbach91/nvbach91/assets/20724910/4e4253a0-ff3d-4730-b861-f3fbd328e463'],
//    ['product_id' => 3, 'name' => 'Kent',         'price' => '47.90', 'img' => 'https://github.com/nvbach91/nvbach91/assets/20724910/1440b402-110c-4442-9272-3cdd9b178b71'],
//    ['product_id' => 4, 'name' => 'Haden',        'price' => '51.90', 'img' => 'https://github.com/nvbach91/nvbach91/assets/20724910/7da75bd6-592b-4c81-be72-7297e006ea43'],
//    ['product_id' => 5, 'name' => 'Keitt',        'price' => '39.90', 'img' => 'https://github.com/nvbach91/nvbach91/assets/20724910/2c27b5ac-7d03-4fcd-ae0a-e58b4c239cfb'],
//    ['product_id' => 6, 'name' => 'Francine',     'price' => '59.90', 'img' => 'https://github.com/nvbach91/nvbach91/assets/20724910/9bcba5fc-ecf1-4e9e-9dda-d3f340df30f4'],
// ];

// pote tato data vlozime do databaze a ziskame je zpatky do aplikace pomoci dotazovani do databaze
// INSERT INTO `products` (`name`, `price`, `img`)
// VALUES
// ('Tommy Atkins', '40.90', 'https://github.com/nvbach91/nvbach91/assets/20724910/1983948a-b927-4235-b0bf-adb9a11abcbd'),
// ('Ataulfo',      '61.90', 'https://github.com/nvbach91/nvbach91/assets/20724910/4e4253a0-ff3d-4730-b861-f3fbd328e463'),
// ('Kent',         '48.90', 'https://github.com/nvbach91/nvbach91/assets/20724910/1440b402-110c-4442-9272-3cdd9b178b71'),
// ('Haden',        '52.90', 'https://github.com/nvbach91/nvbach91/assets/20724910/7da75bd6-592b-4c81-be72-7297e006ea43'),
// ('Keitt',        '40.90', 'https://github.com/nvbach91/nvbach91/assets/20724910/2c27b5ac-7d03-4fcd-ae0a-e58b4c239cfb'),
// ('Francine',     '60.90', 'https://github.com/nvbach91/nvbach91/assets/20724910/9bcba5fc-ecf1-4e9e-9dda-d3f340df30f4');

// třída ProductsDB je definována v souboru ProductsDB.php
// $productsDB = new ProductsDB();
// custom metoda `find` pošle SQL dotaz do databáze a vrátí všechny produkty z databáze
// $products = $productsDB->find();


?>

