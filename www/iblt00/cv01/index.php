<?php

$name = 'Tomas';
$surname = 'Ibl';
$avatar = "./profileImgs/maleBase.png";
$age = 24;
$company = 'Random Company Name';
$position = 'Random Position';
$street = 'Chair st.';
$streetNumber1 = 25;
$streetNumber2 = 1456;
$town = 'Awesome Town';
$forHire = true;
$tel = '+420 666 666 666';
$email = 'dontEmailMe@doit.com';
$webPage = 'www.someWebsite.com';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Card</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" type="text/css" href="./styles/main.css">
</head>

<body>
    <main class="container">
        <h1>My 1st Business Card in PHP</h1>
        <div class="b-card">
            <div class="bc-head"><?php echo $name . ' ' . $surname ?></div>
            <div class="bc-content">
                <div class="bc-info">
                    <p><b>Age: </b><?php echo $age ?></p>
                    <p><b>Company: </b><?php echo $company ?></p>
                    <p><b>Position: </b><?php echo $position ?></p>
                    <p><b>Street: </b><?php echo $street ?></p>
                    <p><b>N. </b><?php echo $streetNumber1 . '/' . $streetNumber2 ?> </p>
                    <p><b>Town: </b><?php echo $town ?></p>
                    <p><b>Open for hire: </b><?php echo $forHire ? 'Yes' : 'No' ?></p>
                </div>
                <div class="bc-avatar">
                    <img src="<?php echo $avatar ?>" alt="profile picture" width="220px" height="220px">
                </div>
            </div>
            <div class="bc-foot">
                <div><i class='fas fa-phone'></i><?php echo $tel ?></div>
                <div><i class='fas fa-envelope'></i><?php echo $email ?></div>
                <div><i class='fas fa-globe'></i><?php echo $webPage ?></div>
            </div>
        </div>
    </main>

</body>

</html>