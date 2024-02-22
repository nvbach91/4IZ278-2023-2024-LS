<?php
$lastName = "Boxan";
$firstName = "David";
$occupation = "student, data scientist";
$company = [
    "name" => "Ernst & Young",
    "street" => "Na Florenci",
    "houseNumber1" => 2116,
    "houseNumber2" => 15,
    "city" => "Praha",
    "logoLink" => "https://upload.wikimedia.org/wikipedia/commons/3/34/EY_logo_2019.svg"
];
$contact = [
    "phone" => "+420 705 844 114",
    "email" => "david.boxan@cz.ey.com",
    "web" => "https://github.com/boxandav"
];
$lookingForWork = false;
$age = 22;

$bodyBackground = "https://virtualbackgrounds.site/wp-content/uploads/2020/07/windows-xp-wallpaper-bliss.jpg";
$cardBackground = "https://image.slidesdocs.com/responsive-images/background/business-card-line-texture-white-fresh-business-card-powerpoint-background_8485d73f09__960_540.jpg";
?>

<html lang="en">
    <head>
        <title><?php echo $firstName . " " . $lastName; ?></title>
        <link rel="stylesheet" type="text/css" href="static/style.css">
        <meta charset="utf-8">
    </head>
    <body style="background-image: url('<?php echo $bodyBackground; ?>')">
        <div id="business-card" style="background-image: url('<?php echo $cardBackground; ?>')">
            <table><tr>
                <td>
                    <div id="name-column">
                        <img src="<?php echo $company['logoLink']; ?>"/>
                        <p style="font-size: 1.5rem"><b><?php echo $firstName . " " . $lastName; ?></b> <em><?php echo $age; ?></em></p>
                        <p><b><?php echo $occupation; ?></b></p>
                    </div>
                </td>
                <td>
                    <div id="company-column" style="margin-left: 1.5rem">
                        <p><?php echo $company["name"] ?></p>
                        <p><?php echo $company["street"] . " " . $company["houseNumber1"] . "/" . $company["houseNumber2"] . ", " . $company["city"]; ?></p>
                        <hr/>
                        <p><?php echo $contact["phone"] ?></p>
                        <p><?php echo $contact["email"] ?></p>
                        <p><a href="<?php echo $contact['web']; ?>">Visit my web</a></p>
                    </div>
                </td>
            </tr></table>
        </div>
        <br/>
        <p>I'm currently<?php if (!$lookingForWork) { echo " not "; } ?> looking for work.</p>
    </body>
</html>