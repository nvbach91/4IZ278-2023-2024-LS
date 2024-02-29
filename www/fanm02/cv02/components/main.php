<?php
require './utils/utils.php';

$people = generatePeople()
?>

<?php foreach($people as $person): ?>
    <div class="person">
        <div class="card">
            <div class="front-container">
                <div class="front-left">
                    <img class="logo" src="<?php echo $person -> avatarLink; ?>">

                </div>
                <div class="front-right">
                    <h2><?php echo $person -> getFullName(); ?></h2>
                    <p><span class="label">Position:</span> <span class="value"><?php echo $person -> position; ?></span></p>
                    <p><span class="label">Company:</span> <span class="value"><?php echo $person -> company; ?></span></p>
                </div>
                
            </div>
        </div>

        <div class="card">
            <p><span class="label">Age:</span> <span class="value"><?php echo $person -> getAge(); ?> years old</span></p>
            <p><span class="label">Address:</span> <span class="value"><?php echo $person -> getAddress(); ?></span></p>
            <p><span class="label">Phone:</span> <span class="value"><?php echo $person -> phone; ?></span></p>
            <p><span class="label">Email:</span> <span class="value"><?php echo $person -> email; ?></span></p>
            <p><span class="label">Website:</span> <span class="value"><?php echo $person -> website ?></span></p>
            <p><span class="label">Looking for job:</span> <span class="value"><?php echo $person -> jobLookout ? 'Yes' : 'No' ?></span></p>
            
        </div>
    </div>
<?php endforeach; ?>