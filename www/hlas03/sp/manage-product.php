<?php
session_start();
require __DIR__ . '/include/header.php';
require_once __DIR__ . '/db/ProductsDB.php';
require_once __DIR__ . '/db/CategoriesDB.php';

if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 2) {
    echo "Nemáte oprávnění přistupovat na tuto stránku.";
    exit();
}

$productsDB = new ProductsDB();
$categoriesDB = new CategoriesDB();
$errors = [];
$success = false;

$categories = $categoriesDB->find();
$product = [
    'name' => '',
    'price' => '',
    'description' => '',
    'stock' => '',
    'img_format' => ''
];
$selected_categories = [];

if (isset($_GET['product_id'])) {
    $product = $productsDB->findByProductId($_GET['product_id']);
    if (!$product) {
        exit();
    }
    $selected_categories = $productsDB->findCategoriesByProductId($_GET['product_id']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $price = filter_var($_POST['price'], FILTER_VALIDATE_FLOAT);
    $description = trim($_POST['description']);
    $stock = filter_var($_POST['stock'], FILTER_VALIDATE_INT);
    $selected_categories = array_map('intval', $_POST['categories'] ?? []);
    $img_format = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

    if ($price === false || $stock === false) {
        $errors[] = "Neplatná cena nebo skladová zásoba.";
    }

    if (empty($errors)) {
        if (isset($_GET['product_id'])) {
            if (empty($_FILES['image']['name'])) {
                $img_format = $product['img_format'];
            }

            $productsDB->update($_GET['product_id'], $name, $price, $description, $stock);
            $product_id = $_GET['product_id'];
        } else {
            $product_id = $productsDB->create($name, $price, $description, $stock, $img_format);
        }

        if ($product_id) {
            $target_dir = "./assets/product_img/";
            $target_file = $target_dir . $product_id . '.' . $img_format;

            $allowed_formats = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            if (!in_array(strtolower($img_format), $allowed_formats)) {
                $errors[] = "Nepovolený formát obrázku. Povolené formáty jsou: " . implode(", ", $allowed_formats);
            }

            if (!empty($_FILES['image']['name']) && empty($errors) && move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            } elseif (!empty($_FILES['image']['name'])) {
                $errors[] = "Nahrání obrázku selhalo.";
            }

            if (empty($errors)) {
                $productsDB->clearCategories($product_id);
                foreach ($selected_categories as $category_id) {
                    $productsDB->assignCategory($product_id, $category_id);
                }
                $success = true;

                $product = [
                    'name' => $name,
                    'price' => $price,
                    'description' => $description,
                    'stock' => $stock,
                    'img_format' => $img_format
                ];
            }
        } else {
            $errors[] = "Vytvoření/úprava produktu selhalo.";
        }
    }
}
?>

<div class="container mt-5">
    <h2><?php echo isset($_GET['product_id']) ? 'Upravit produkt' : 'Přidat nový produkt'; ?></h2>
    <form action="manage-product<?php echo isset($_GET['product_id']) ? '?product_id=' . htmlspecialchars($_GET['product_id'], ENT_QUOTES, 'UTF-8') : ''; ?>" method="post" enctype="multipart/form-data">
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="alert alert-success">
                <p>Produkt byl úspěšně <?php echo isset($_GET['product_id']) ? 'upraven' : 'přidán'; ?>.</p>
            </div>
        <?php endif; ?>
        <div class="form-group">
            <label for="name">Název produktu:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div class="form-group">
            <label for="price">Cena:</label>
            <input type="number" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($product['price'], ENT_QUOTES, 'UTF-8'); ?>" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="description">Popis:</label>
            <textarea class="form-control" id="description" name="description" rows="3" required><?php echo htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>
        <div class="form-group">
            <label for="stock">Skladová zásoba:</label>
            <input type="number" class="form-control" id="stock" name="stock" value="<?php echo htmlspecialchars($product['stock'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div class="form-group">
            <label for="image">Obrázek produktu:</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>
        <div class="form-group">
            <label>Kategorie:</label><br>
            <?php foreach ($categories as $category): ?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="category_<?php echo htmlspecialchars($category['category_id'], ENT_QUOTES, 'UTF-8'); ?>" name="categories[]" value="<?php echo htmlspecialchars($category['category_id'], ENT_QUOTES, 'UTF-8'); ?>"
                        <?php echo in_array($category['category_id'], $selected_categories) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="category_<?php echo htmlspecialchars($category['category_id'], ENT_QUOTES, 'UTF-8'); ?>">
                        <?php echo htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8'); ?>
                    </label>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="submit" class="btn btn-primary"><?php echo isset($_GET['product_id']) ? 'Upravit produkt' : 'Přidat produkt'; ?></button>
        <a href="manage-products" class="btn btn-secondary">Zpět</a>
    </form>
</div>

<?php require __DIR__ . '/include/footer.php'; ?>
