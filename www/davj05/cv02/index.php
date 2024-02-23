<?php


$greetings = "Osobní vizitka";

?>

<!DOCTYPE html>
<html lang="en">

    <?php include("includes/head.php"); ?>

<body>
    <h1><?php echo $greetings; ?></h1>

    <?php require "components/cards.php"; ?>
    
    
</body>
</html>