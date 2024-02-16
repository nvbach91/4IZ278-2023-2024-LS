<?php
// Definice proměnných
$avatar = "airbnb-cleaning-min.png"; // Cesta k obrázku avatara nebo loga
$prijmeni = "Lorenc";
$jmeno = "Samuel";
$datumNarozeni = "02.10.2000"; // Datum ve formátu RRRR-MM-DD
$povolani = "Web Developer";
$nazevFirmy = "Kodér s.r.o.";
$ulice = "Kódová";
$cisloPopisne = "123";
$cisloOrientacni = "45";
$mesto = "Praha";
$telefon = "+420 728 980 270";
$isMarried = false;
$email = "lorencsam@seznam.cz";
$web = "www.magu.co";
$shaniPraci = false; // true pro Ano, false pro Ne

// Výpočet věku
$datumNarozeni = new DateTime($datumNarozeni);
$nynejsiDatum = new DateTime();
$vek = $nynejsiDatum->diff($datumNarozeni)->y;
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Vizitka <?php echo $jmeno . " " . $prijmeni; ?></title>
    <style>
        .sekce1{
            width: 100%;
        }
        .vizitka {
            position: absolute;
            top:40%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            width: 600px;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-around;
            background-color: #292a30;
            border-radius: 10px;
            box-shadow: 0px 5px 20px #000;
            border: none;
        }
        .vizitka img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
        }
        .vizitka h1, .vizitka h2 {
            margin: 0;
            padding: 0;
            color: white;

        }
        .vizitka p {
            margin: 10px 0;
            color: white;
        }
        .vizitka .div1{
            
        }
        .vizitka .div2 a{
            color: white;
            text-decoration: underline;
        }
        .vizitka>*+*{
            margin-left: 20px;
        }
    </style>
</head>
<body>

<section class="sekce1">

    <div class="vizitka">
        <div class="div1">
            <img src="<?php echo $avatar; ?>" alt="Avatar">
        </div>
        <div class="div2">
            <h1><?php echo $jmeno . " " . $prijmeni; ?></h1>
            <p>Věk: <?php echo $vek; ?></p>
            <p>Povolání: <?php echo $povolani; ?></p>
            <h2><?php echo $nazevFirmy; ?></h2>
            <p>Adresa: <?php echo "$ulice $cisloPopisne/$cisloOrientacni, $mesto"; ?></p>
            <p>Telefon: <?php echo $telefon; ?></p>
            <p>Email: <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></p>
            <p>Webové stránky: <a href="http://<?php echo $web; ?>" target="_blank"><?php echo $web; ?></a></p>
            <p>Hledám práci: <?php echo $shaniPraci ? "Ano" : "Ne"; ?></p>
            <p>Ženatý? <?php echo $isMarried === true ? "Ano": "Ne"; ?></p>
        </div>

      


    </div>
    
</section>

</body>
</html>
