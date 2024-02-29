<?php
    require "classes/Person.php";

    $person1 = new Person($first_name, $last_name, $birth_date, $profession, $company, $address, $phone, $email, $website, $open_to_work, $logo);
    $person2 = new Person("John", "Wick", "1990-01-01", "Killer", "Dont know", "Somewhere in USA", "+1 123 456 789", "test@email", "www.google.com", true, "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQUq9BqXPjqrt7YYBvfNHcWa88qKLbZcstXOh_mcnNiSA&s");
    $person3 = new Person("Jack", "Sparrow", "1778-03-08", "Pirate", "Pirate Bay", "Carribean", "+1 123 456 789", "test@email", "www.google.com", true, "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQUq9BqXPjqrt7YYBvfNHcWa88qKLbZcstXOh_mcnNiSA&s");
        
    $people = [];
    array_push($people, $person1, $person2, $person3);
    
    
?>

<?php foreach ($people as $person): ?>
        <div class="card">
        <div class="logo">
            <img src="<?php echo $person->logo; ?>" alt="logo">
        </div>
        <div class="data">

            <div class="full_name">
                <?php echo $person->getFullName(); ?>
            </div>
            <div class="age">
                <?php echo $person->getAge(); ?>
            </div>
            <div class="proffesion">
                <?php echo $person->profession; ?>
            </div>
            <div class="company">
                <?php echo $person->company; ?>
            </div>
            <div class="address">
                <?php echo $person->address; ?>
            </div>
            <div class="phone">
                <?php echo $person->phone; ?>
            </div>
            <div class="email">
                <?php echo $person->email; ?>
            </div>
            <div class="website">
                <?php echo $person->website; ?>
            </div>
            <div class="open_to_work">
                <?php echo $person->open_to_work; ?>
            </div>
        </div>
    </div>
    <?php endforeach; ?>