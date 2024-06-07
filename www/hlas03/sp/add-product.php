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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitizace a validace vstupů
    $name = htmlspecialchars(trim($_POST['name']), ENT_QUOTES, 'UTF-8');
    $price = filter_var($_POST['price'], FILTER_VALIDATE_FLOAT);
    $description = htmlspecialchars(trim($_POST['description']), ENT_QUOTES, 'UTF-8');
    $stock = filter_var($_POST['stock'], FILTER_VALIDATE_INT);
    $selected_categories = array_map('intval', $_POST['categories'] ?? []);
    $img_format = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

    if ($price === false || $stock === false) {
        $errors[] = "Neplatná cena nebo skladová zásoba.";
    }

    if (empty($errors)) {
        // Insert the new product into the database to get the product ID
        $product_id = $productsDB->create($name, $price, $description, $stock, $img_format);

        if ($product_id) {
            $target_dir = "./assets/product_img/";
            $target_file = $target_dir . $product_id . '.' . $img_format;

            // Validate image upload
            $allowed_formats = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            if (!in_array(strtolower($img_format), $allowed_formats)) {
                $errors[] = "Nepovolený formát obrázku. Povolené formáty jsou: " . implode(", ", $allowed_formats);
            }

            if (empty($errors) && move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // Insert categories into product_categories table
                foreach ($selected_categories as $category_id) {
                    $productsDB->assignCategory($product_id, $category_id);
                }
                $success = true;
            } else {
                $errors[] = "Nahrání obrázku selhalo.";
            }
        } else {
            $errors[] = "Vytvoření produktu selhalo.";
        }
    }
}
?>

<div class="container mt-5">
    <h2>Přidat nový produkt</h2>
    <form action="add-product" method="post" enctype="multipart/form-data">
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="alert alert-success">
                <p>Produkt byl úspěšně přidán.</p>
            </div>
        <?php endif; ?>
        <div class="form-group">
            <label for="name">Název produktu:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="price">Cena:</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="description">Popis:</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="stock">Skladová zásoba:</label>
            <input type="number" class="form-control" id="stock" name="stock" required>
        </div>
        <div class="form-group">
            <label for="image">Obrázek produktu:</label>
            <input type="file" class="form-control-file" id="image" name="image" required>
        </div>
        <div class="form-group">
            <label>Kategorie:</label><br>
            <?php foreach ($categories as $category): ?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="category_<?php echo htmlspecialchars($category['category_id'], ENT_QUOTES, 'UTF-8'); ?>" name="categories[]" value="<?php echo htmlspecialchars($category['category_id'], ENT_QUOTES, 'UTF-8'); ?>">
                    <label class="form-check-label" for="category_<?php echo htmlspecialchars($category['category_id'], ENT_QUOTES, 'UTF-8'); ?>">
                        <?php echo htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8'); ?>
                    </label>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="submit" class="btn btn-primary">Přidat produkt</button>
    </form>
</div>

<?php require __DIR__ . '/include/footer.php'; ?>
