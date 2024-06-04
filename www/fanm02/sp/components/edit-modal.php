<div class='modal fade' id='seditModal<?php echo $meal['meal_id']; ?>' tabindex='-1' role='dialog' aria-labelledby='seditModalLabel<?php echo $meal['meal_id']; ?>' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='seditModalLabel<?php echo $meal['meal_id']; ?>'>Edit Meal</h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-body'>
                <form action='profile.php' method='POST'>
                    <input type='hidden' name='mealId' value='<?php echo $meal['meal_id']; ?>'>
                    <div class='form-group'>
                        <label for='editTitle<?php echo $meal['meal_id']; ?>'>Title</label>
                        <input type='text' required class='form-control' id='editTitle<?php echo $meal['meal_id']; ?>' name='title' value='<?php echo $meal['title']; ?>' required>
                    </div>
                    <div class='form-group'>
                        <label for='editDescription<?php echo $meal['meal_id']; ?>'>Description</label>
                        <textarea required class='form-control' id='editDescription<?php echo $meal['meal_id']; ?>' name='description' required><?php echo $meal['description']; ?></textarea>
                    </div>
                    <div class='form-group'>
                        <label for='editPickupTime<?php echo $meal['meal_id']; ?>'>Pickup Time</label>
                        <input type='datetime-local' class='form-control' id='editPickupTime<?php echo $meal['meal_id']; ?>' name='pickup_time' value='<?php echo date('Y-m-d\TH:i', strtotime($meal['pickup_time'])); ?>' required>
                    </div>
                    <div class='form-group'>
                        <label for='editPickupDorm<?php echo $meal['meal_id']; ?>'>Pickup Dormitory</label>
                        <select class='form-control' id='editPickupDorm<?php echo $meal['meal_id']; ?>' name='pickup_dorm' required>
                            <?php foreach ($dormsDb->find() as $dorm) : ?>
                                <option value='<?php echo $dorm['id']; ?>' <?php echo $meal['pickup_dorm'] == $dorm['id'] ? 'selected' : ''; ?>><?php echo $dorm['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class='form-group'>
                        <label for='editPickupRoom<?php echo $meal['meal_id']; ?>'>Pickup Room</label>
                        <input type='text' required class='form-control' id='editPickupRoom<?php echo $meal['meal_id']; ?>' name='pickup_room' value='<?php echo $meal['pickup_room']; ?>'>
                    </div>
                    <div class='form-group'>
                        <label for='editPrice<?php echo $meal['meal_id']; ?>'>Price</label>
                        <input type='number' class='form-control' id='editPrice<?php echo $meal['meal_id']; ?>' name='price' value='<?php echo $meal['price']; ?>' required>
                    </div>
                    <input type='hidden' name='meal_id' value='<?php echo $meal['meal_id']; ?>'>
                    <button type='submit' class='btn btn-primary'>Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>