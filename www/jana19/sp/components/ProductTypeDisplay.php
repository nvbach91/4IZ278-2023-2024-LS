<?php
require_once __DIR__ . '/../db/ProductsDatabase.php';

$productsDB = new ProductsDatabase();
$productTypes = $productsDB->readAllProductTypes();

// Capture the current URL parameters
$currentUrlParams = $_SERVER['QUERY_STRING'];
?>

<?php
require_once __DIR__ . '/../db/ProductsDatabase.php';

$productsDB = new ProductsDatabase();
$productTypes = $productsDB->readAllProductTypes();

// Capture the current URL parameters
$currentUrlParams = $_SERVER['QUERY_STRING'];
?>

<form method="GET" action="index.php">
    <div class="list-group">
        <div class="list-group-item">
            <h4>Display only: </4>
        </div>
        <div class="list-group-item">
            <input type="checkbox" id="isGiftSet" name="isGiftSet" value="true" <?php if (isset($_GET['isGiftSet'])) echo 'checked'; ?> title="Display only products that are gift sets.">
            <label for="isGiftSet">Gift sets</label>
        </div>
        <div class="list-group-item">
            <input type="checkbox" id="isCaffeineFree" name="isCaffeineFree" value="true" <?php if (isset($_GET['isCaffeineFree'])) echo 'checked'; ?> title="Display only products that are decaffeinated or naturally caffeine-free.">
            <label for="isCaffeineFree">Caffeine-Free products</label>
        </div>
        <?php foreach ($productTypes as $productType) : ?>
            <div class="list-group-item">
                <input type="checkbox" id="productType_<?php echo $productType['idProductType']; ?>" name="productType" value="<?php echo $productType['idProductType']; ?>" <?php if (isset($_GET['productType']) && str_contains($productType['idProductType'], $_GET['productType'])) echo 'checked'; ?> title="Display only products that are <?php echo $productType['typeName']; ?> teas.">
                <label for="productType_<?php echo $productType['idProductType']; ?>"><?php echo $productType['typeName']; ?></label>
            </div>
        <?php endforeach; ?>
        <button class="btn btn-secondary" type="submit">Apply Filters</button>
    </div>
</form>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script>
$(document).ready(function() {
    // Parse the current URL parameters
    var urlParams = new URLSearchParams(window.location.search);

    // Function to set checkbox states based on URL parameters
    function setCheckboxStatesFromUrlParams() {
        $('input[type=checkbox]').each(function() {
            var paramName = $(this).attr('name');
            var paramValue = $(this).val();
            var isChecked = false;

            // Check if the parameter exists in the URL and its value matches
            if (urlParams.has(paramName)) {
                if (paramName === 'productType') {
                    // Special handling for productType since it can have multiple values
                    isChecked = Array.from(urlParams.getAll(paramName)).includes(paramValue);
                } else {
                    isChecked = urlParams.get(paramName) === paramValue;
                }
            }

            $(this).prop('checked', isChecked);
        });
    }

    // Set checkbox states when the document is ready
    setCheckboxStatesFromUrlParams();
});
</script>

