<div class='modal fade' id='sdeleteModal<?php echo $meal['meal_id']; ?>' tabindex='-1' role='dialog' aria-labelledby='sdeleteModalLabel<?php echo $meal['meal_id']; ?>' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='sdeleteModalLabel<?php echo $meal['meal_id']; ?>'>Confirmation</h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-body'>
                Are you sure you want to delete this meal?
            </div>
            <form method="post" action="delete-listing.php">
                <input type="hidden" name="meal_id" value="<?php echo $meal['meal_id']; ?>">
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>
                    <button type='submit' class='btn btn-danger'>Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>