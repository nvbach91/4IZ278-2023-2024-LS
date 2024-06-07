<?php
    require_once 'utils/helpers.php';
?>

<div class='col-md-4'>
    <div class='card' style='width: 350px; height: min-content;'>
        <div class="image-container">
            <?php if ($meal['status'] == 1): ?>
                <div class="overlay-text selling-label">Selling</div>
            <?php else: ?>
                <div class="overlay-text sold-label">Sold</div>
            <?php endif; ?>
            <img class='card-img-top' style='width: 100%; height: 150px; object-fit: cover;' src='<?php echo ($meal["photo_url"] ?? "https://marie-sklodowska-curie-actions.ec.europa.eu/sites/default/files/styles/eac_ratio_16_9_xl/public/2021-11/foodtests.jpg?h=8f5db356&itok=Ycsgu1ew"); ?>' alt='<?php echo $meal['title']; ?> photo'>
        </div>
        <div class='card-body'>
            <h5 class='card-title'><?php echo $meal['title']; ?></h5>
            <h6 class='card-subtitle mb-2 text-muted'><?php echo $meal['price']; ?>$</h6>
            <p class='card-text'><?php echo $meal['description']; ?></p>
            <p class='card-time'><b><?php echo formatDate($meal['pickup_time']); ?></b></p>
            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#seditModal<?php echo $meal['meal_id']; ?>'>View Details</button>
            <?php if ($meal['status'] == 2): ?>
                <button type='button' class='btn btn-secondary' data-toggle='modal' data-target='#schatModal<?php echo $meal['meal_id']; ?>'>Chat</button>
            <?php endif; ?>
            <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#sdeleteModal<?php echo $meal['meal_id']; ?>'>Delete</button>
            <?php
                include './components/confirm-delete-modal.php';
            ?>
        </div>
    </div>
</div>