<div class='modal fade' id='bmealModal<?php echo $meal['meal_id']; ?>' tabindex='-1' role='dialog' aria-labelledby='bmealModalLabel<?php echo $meal['meal_id']; ?>' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='bmealModalLabel<?php echo $meal['meal_id']; ?>'><?php echo $meal['title']; ?></h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-body'>
                <p><?php echo $meal['description']; ?></p>
                <p><b><?php echo date_format(date_create($meal['pickup_time']), 'Y/m/d H:i'); ?></b></p>
                <p><?php echo $dormsDb->getDormitory($meal['pickup_dorm'])['name'];
                    if ($meal['pickup_room'] != null) {
                        echo ' (' . $meal['pickup_room'] . ')';
                    } ?></p>
                <p>Price: <?php echo $meal['price']; ?>$</p>
            </div>
            <div class='modal-footer'>
                <?php if ($_SESSION['user']['username'] != $user['username'] && $meal['status'] == 1) : ?>
                    <a href='paywall.php?meal_id=<?php echo $meal['meal_id']; ?>' class='btn btn-primary'>Purchase</a>
                <?php endif; ?>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
            </div>
        </div>
    </div>
</div>