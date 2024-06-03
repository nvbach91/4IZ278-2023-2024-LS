<div class='col-md-4'>
    <div class='card' style='width: 350px; height: min-content;'>
        <img class='card-img-top' style='width: 100%; height: 150px; object-fit: cover;' src='<?php echo $meal['photo_url']; ?>' alt='<?php echo $meal['title']; ?> photo'>
        <div class='card-body'>
            <h5 class='card-title'><?php echo $meal['title']; ?></h5>
            <h6 class='card-subtitle mb-2 text-muted'><?php echo $meal['price']; ?>$</h6>
            <p class='card-text'><?php echo $meal['description']; ?></p>
            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#bmealModal<?php echo $meal['meal_id']; ?>'>View Details</button>
            <button type='button' class='btn btn-secondary' data-toggle='modal' data-target='#bchatModal<?php echo $meal['meal_id']; ?>'>Chat</button>
        </div>
    </div>
</div>