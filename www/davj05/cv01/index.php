<?php
    $greetings = "Osobní vizitka";
    $first_name = "Jakub";
    $last_name = "David";
    $birth_date = "2000-12-18";
    $profession = "CEO";
    $company = "Resonect Technology s.r.o.";
    $address = "Korunní 2569/108, Vinohrady, Praha 10";
    $phone = "+420 739 755 098";
    $email = "jakub.david@resonect.cz";
    $website = "www.resonect.cz";
    $open_to_work = false;

    $birth_date_object = new DateTime($birth_date);
    $current_date_object = new DateTime('now');
    $age_difference = $current_date_object->diff($birth_date_object); //Method to calculate the difference between two dates
    $age = $age_difference->y; //Get the difference in years

    $logo = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQUq9BqXPjqrt7YYBvfNHcWa88qKLbZcstXOh_mcnNiSA&s';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>Osobní vizitka</title>
</head>
<body>
    <h1><?php echo $greetings; ?></h1>


    <div class="card">
        <div class="logo">
            <img src="<?php echo $logo; ?>" alt="logo">
        </div>
        <div class="data">

            <div class="first_name">
                <?php echo $first_name; ?>
            </div>
            <div class="last_name">
                <?php echo $last_name; ?>
            </div>
            <div class="age">
                <?php echo $age; ?>
            </div>
            <div class="proffesion">
                <?php echo $profession; ?>
            </div>
            <div class="company">
                <?php echo $company; ?>
            </div>
            <div class="address">
                <?php echo $address; ?>
            </div>
            <div class="phone">
                <?php echo $phone; ?>
            </div>
            <div class="email">
                <?php echo $email; ?>
            </div>
            <div class="website">
                <?php echo $website; ?>
            </div>
            <div class="open_to_work">
                <?php echo $open_to_work; ?>
            </div>

        </div>
    </div>
    
</body>
</html>