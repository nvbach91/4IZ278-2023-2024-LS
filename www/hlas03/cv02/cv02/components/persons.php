<?php 

require "./classes/Person";

$taccoMan = new Person(
    "https://i.pinimg.com/736x/78/38/9a/78389a5e9f7a2ebce15dc7de24841a42.jpg",
    "https://www.tacosito.cz/images/logo.png",
    "Mr",
    "Tacco",
    40,
    "Best Tacco Seller",
    "Taccosito",
    "Riegrova",
    "1/318",
    "544 01",
    "Dvůr Králové nad Labem",
    "770 154 813",
    "mrtacco@gmail.com",
    "https://www.mrtacco.cz/",
    True
);


$shrek = new Person(
    "https://static.dezeen.com/uploads/2023/09/airbnb-shreks-swamp-scotlans_dezeen_1704_sq_0-1.jpg",
    "https://p7.hiclipart.com/preview/428/132/7/5bbf9f72d90ba.jpg",
    "Shrek",
    "Ogre",
    30,
    "Profesional Ogre",
    "Ogre.s.r.o",
    "Shrek's Swap",
    "123",
    "4567",
    "the Lordship of Lord Farquaad",
    "354 221 532",
    "shrek@gmail.com",
    "https://www.shrek.cz/",
    True
);

$donkey = new Person(
    "https://cdn.shopify.com/s/files/1/0297/2087/1049/files/Dragon-in-flight.jpg?v=1588778031",
    "https://upload.wikimedia.org/wikipedia/en/6/6c/Donkey_%28Shrek%29.png",
    "Donkey",
    "From Shrek",
    40,
    "Donkey",
    "Ogre.s.r.o",
    "Shrek's Swap",
    "123",
    "4567",
    "the Lordship of Lord Farquaad",
    "431 324 123",
    "donkey@gmail.com",
    "https://www.donkey.cz/",
    True
);


$persons = [];
array_push($persons, $taccoMan);
array_push($persons, $shrek);
array_push($persons, $donkey);
?>

<main>
    <ul>
        <?php foreach($persons as $person): ?>
            <li class=one_card>    
                <div class="business-card"  style="background-image: url(<?php echo $person->backgrounPhoto?>)">
                    <div class="content-container-front">
                        <div>   
                            <div class="first-name item inline-item"><h1><?php echo $person->firstnName?></h1></div>
                            <div class="last-name item inline-item"><h1><?php echo $person->lastName?></h1></div>
                            <div class="job item"><p><?php echo $person->job?></p></div>
                        </div>
                    </div>
                </div>


                <div class="business-card bussiness-card-back"  style="background-image: url(<?php echo $person->backgrounPhoto?>)">
                    <div class="content-container-back">
                        <div class="logo-container">
                            <div class="logo"><img src="<?php echo $person->logo?>" alt=""></div>
                        </div>
                        <div class="details-container">
                            <div class="item"><p><strong>Name:</strong> <?php echo $person->firstnName?> <?php echo $person->lastName?></p></div>
                            <div class="item"><p><strong>Age:</strong> <?php echo $person->age?></p></div>
                            <div class="item"><p><strong>Job:</strong> <?php echo $person->job?></p></div>
                            <div class="item"><p><strong>Company name:</strong> <?php echo $person->companyName?></p></div>
                            <div class="item"><p><strong>Adress:</strong> <?php echo $person->street?> <?php echo $person->descriptiveNum?></p></div>
                            <div class="item"><p><strong>City:</strong> <?php echo $person->city?></p></div>
                            <div class="item"><p><strong>Postal code:</strong> <?php echo $person->postalCode?></p></div>
                            <div class="item"><p><strong>Phone:</strong> <?php echo $person->phoneNum?></p></div>
                            <div class="item"><p><strong>Email:</strong> <?php echo $person->email?></p></div>
                            <div class="item"><p><strong>Websites:</strong> <?php echo $person->website?></p></div>
                            <div class="item"><p> <?php if($person->lookingForJob){echo "Now available for contracts";} else {echo $person->lookingForJob;}?></p></div>
                        </div>
                    </div>
                </div>

            <li>
        <?php endforeach; ?>
    </ul>
</main>
