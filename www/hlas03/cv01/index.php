<?php
$backgrounPhoto = "https://i.pinimg.com/736x/78/38/9a/78389a5e9f7a2ebce15dc7de24841a42.jpg";
$logo = "https://www.tacosito.cz/images/logo.png";
$firstnName = "Mr";
$lastName = "Tacco";
$age = 40;
$job = "Best Tacco Seller";
$companyName = "Taccosito";
$street = "Riegrova";
$descriptiveNum = "1/318";
$postalCode = "544 01";
$city = "Dvůr Králové nad Labem";
$phoneNum = "770 154 813";
$email = "mrtacco@gmail.com";
$website = "https://www.mrtacco.cz/";
$lookingForJob = True;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css"> 
</head>

<body>

    <main>
        <div class="business-card"  style="background-image: url(<?php echo $backgrounPhoto?>)">
            <div class="content-container-front">
                <div>   
                    <div class="first-name item inline-item"><h1><?php echo $firstnName?></h1></div>
                    <div class="last-name item inline-item"><h1><?php echo $lastName?></h1></div>
                    <div class="job item"><p><?php echo $job?></p></div>
                </div>
            </div>
        </div>

        

        <div class="business-card bussiness-card-back"  style="background-image: url(<?php echo $backgrounPhoto?>)">
            <div class="content-container-back">
                <div class="logo-container">
                    <div class="logo"><img src="<?php echo $logo?>" alt=""></div>
                </div>
                <div class="details-container">
                    <div class="item"><p><strong>Name:</strong> <?php echo $firstnName?> <?php echo $lastName?></p></div>
                    <div class="item"><p><strong>Age:</strong> <?php echo $age?></p></div>
                    <div class="item"><p><strong>Job:</strong> <?php echo $job?></p></div>
                    <div class="item"><p><strong>Company name:</strong> <?php echo $companyName?></p></div>
                    <div class="item"><p><strong>Adress:</strong> <?php echo $street?> <?php echo $descriptiveNum?></p></div>
                    <div class="item"><p><strong>City:</strong> <?php echo $city?></p></div>
                    <div class="item"><p><strong>Postal code:</strong> <?php echo $postalCode?></p></div>
                    <div class="item"><p><strong>Phone:</strong> <?php echo $phoneNum?></p></div>
                    <div class="item"><p><strong>Email:</strong> <?php echo $email?></p></div>
                    <div class="item"><p><strong>Websites:</strong> <?php echo $website?></p></div>
                    <div class="item"><p> <?php if($lookingForJob){echo "Now available for contracts";} else {echo $lookingForJob;}?></p></div>
                </div>
            </div>
        </div>
    </main>

</body>

</html>