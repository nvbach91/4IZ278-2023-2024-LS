<?php
    require_once 'utils/helpers.php';
    require_once 'db/Users.php';

    $usersDb = new UsersDB();
    
    $user = $usersDb->getUserByMeal($meal['id']);
?>

<div class='col-md-4'>
    <div class='card' style='width: 350px; height: min-content;'>
        <img class='card-img-top' style='width: 100%; height: 150px; object-fit: cover;' src='<?php echo ($meal["photo_url"] ?? "https://marie-sklodowska-curie-actions.ec.europa.eu/sites/default/files/styles/eac_ratio_16_9_xl/public/2021-11/foodtests.jpg?h=8f5db356&itok=Ycsgu1ew"); ?>' alt='<?php echo $meal['title']; ?> photo'>
        <div class='card-body'>
            <h5 class='card-title'><?php echo $meal['title']; ?></h5>
            <h6 class='card-subtitle mb-2 text-muted'><?php echo $meal['price']; ?>$</h6>
            <p class='card-text'><?php echo $meal['description']; ?></p>
            <p class='card-time'><b><?php echo formatDate($meal['pickup_time']); ?></b></p>
            <div class="card-profile-container">
                <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#bmealModal<?php echo $meal['id']; ?>'>View Details</button>
                <div class="card-profile">
                    <div class="card-avatar">
                        <?php
                            if(isset($user['photo_url'])) {
                                echo "<img src='".$user['photo_url']."' style='width: 30px; height: 30px; border-radius: 50%;'> ";
                            }
                            else {
                                echo "<img src='https://www.w3schools.com/howto/img_avatar.png' style='width: 30px; height: 30px; border-radius: 50%;'> ";
                            }
                        ?>
                    </div>
                    <?php echo $user['username']; ?>
                </div>
            </div>
        </div>
    </div>
</div>