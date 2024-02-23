<?php
$avatar = "https://i.pinimg.com/564x/e1/8c/b9/e18cb99f18e3501431afc256ce31735b.jpg";
$name = "Bořislav";
$surname = "Inženýr";
$birthday = date("Y") - 2000;
$job = "Ředitel zeměkoule";
$company = "Meta";
$street = "Abbey Road";
$streetNum1 = "4";
$streetNum2 = "20";
$city = "Londýn";
$phone = "+420 608 992 987";
$email = "borislav.is.alpha@gmail.com";
$web = "www.borislav.com";
$lookingForJob = false;

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
                    <?php echo $name . " " . $surname . " (" . $birthday . " let)"; ?>
                </div>
                <div><?php echo $job ?>, <span style="color: blue"><?php echo $company; ?></span></div>
                <div class="location"><?php echo $street . " " . $streetNum1 . "/" . $streetNum2 . " " . $city ?></div>
            </div>
        </div>
        <div style="display: flex; justify-content: space-between">
            <strong>📞 <?php echo $phone ?></strong>
            <strong>💌 <?php echo $email ?></strong>
        </div>
        <div style="display: flex; justify-content: space-between; margin-top: 60px">
            <div>🛜 <?php echo $web ?></div>
            <div>
                <?php echo $lookingForJob ? '✅ Práci sháním' : '❌ Práci nesháním'; ?>
            </div>
        </div>
    </div>

</body>

</html>