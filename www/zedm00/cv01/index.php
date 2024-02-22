<?php
$firstName = "Marge";
$lastName = "Simpson";
$age = 455;
$job = "Stay at home mom";
$employer = "Walt Disney";
$street="Crow Canyon";
$numberDescriptive=456;
$numberOrientational=4;
$city="Springfield";
$telephone="+1 456 135 6664";
$email = "marge@simpson.com";
$web= "www.marge.com";
$jobNeeded = false;
$backgroudImageUrl = "https://img.freepik.com/free-vector/hand-painted-watercolor-pastel-sky-background_23-2148902771.jpg?w=1380&t=st=1708377020~exp=1708377620~hmac=8187a8a589f8f958881e9f3909ab53ea81458566be7c1cbeea4cae86e806af77"
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Title Here</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>


    <div class="bussiness-card" style="background:  linear-gradient(
          rgba(0, 0, 0, 0.2), 
          rgba(0, 0, 0, 0.3)
        ), url('<?php echo $backgroudImageUrl; ?>') center/cover no-repeat;">
        <div class="header">
            <h2><?php echo $firstName; ?> <?php echo $lastName; ?></h2>
            <h3><?php echo $job; ?></h3>
        </div>

        <div class="content">
            <p><b>Employer:</b> <?php echo $employer; ?></p>
            <p><b>Telephone:</b> <?php echo $telephone; ?></p>
            <p><b>Address:</b> <?php echo $street; ?>
                <?php echo $numberDescriptive; ?>/<?php echo $numberOrientational; ?>, <?php echo $city; ?></p>
            <p><b>Email: </b><?php echo $email; ?></p>
            <p><b>Web: </b> <?php echo $web; ?></p>
            <p><b>Job needed:</b> <?php echo $jobNeeded ? "Yes" : "No"; ?></p>
        </div>
    </div>

</body>

</html>