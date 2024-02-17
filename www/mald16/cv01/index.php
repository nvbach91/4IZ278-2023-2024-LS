<?php 
$avatar = "https://i.pinimg.com/564x/e1/8c/b9/e18cb99f18e3501431afc256ce31735b.jpg";
$jmeno = "Bořislav";
$prijmeni = "Inženýr";
$narozeniny = 2000;
$povolani = "Ředitel zeměkoule";
$firma = "Meta";
$ulice = "Abbey Road";
$popisne = "4";
$orientacni = "20";
$mesto = "Londýn";
$telefon = "+420 608 992 987";
$email = "borislav.is.alpha@gmail.com";
$web = "www.borislav.com";
$shanim_praci = false;

?>

<style>
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;

}
.business-card {
    width: 500px;
    height: 250px;
    border: 1px solid black;
    padding: 20px;
    border-radius: 3px;
    margin: 20px 0 0 20px;
}

.upper-container {
    display: flex;
    align-items: center;
    flex-direction: row;
    margin-bottom: 20px;

}
.avatar {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background-image: url(<?php echo $avatar; ?>);
    background-position: top;
    background-size: cover;
    margin-right: 15px;
}

.name-and-age {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 5px;
}

.location {
    color: gray;
}

</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <div class="business-card">
        <div class="upper-container">
            <div class="avatar"></div>
            <div>
                <div class="name-and-age">
                    <?php echo $jmeno . " " . $prijmeni . " (" . date("Y") - $narozeniny . " let)";?>
                </div>
                <div><?php echo $povolani?>, <span style="color: blue"><?php echo $firma;?></span></div>
                <div class="location"><?php echo $ulice . " " . $popisne . "/" . $orientacni . " " . $mesto ?></div>
            </div>
        </div>
        <div style="display: flex; justify-content: space-between">
            <b>📞 <?php echo $telefon ?></b>
            <b>💌 <?php echo $email ?></b>
        </div>
        <div style="display: flex; justify-content: space-between; margin-top: 60px">
            <div>🛜 <?php echo $web ?></div>
            <div>
                <?php 
                    if ($shanim_praci) {
                        echo "✅ Sháním práci";
                    } else {
                        echo "❌ Nesháním práci";
                    }
                ?>
            </div>
        </div>
   </div>
   
</body>
</html>