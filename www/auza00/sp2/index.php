<?php
session_start();
require 'db.php';

if (!isset($_SESSION['nick-taken'])) {
    $_SESSION['nick-taken'] = "already-taken-not";
}

?>
<!DOCTYPE html>
<html lang='cs'>

<head>
    <meta charset='UTF-8'>
    <link rel='stylesheet' href='css/style.css'>
    <title>I Know A Spot</title>

    <meta name="description"
        content="Mapa pro všechny zkuřky, který si chtějí svoji krásnou chvilku užít na nějakým pěkným místě">
    <meta name="keywords" content="i know a spot, mapa, spot, joint, špek, bong, tráva, marihuana, místo">
    <meta name="author" content="Adam Auzký">

    <link rel='icon' type='image/x-icon' href='img/cannabis-solid.png'>
    <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
    <link
        href='https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap'
        rel='stylesheet'>

    <meta name='viewport' content='width=device-width, initial-scale=1, user-scalable=no'>
    <link rel='stylesheet' href='https://unpkg.com/maplibre-gl@3.6.2/dist/maplibre-gl.css' />
    <script src='https://unpkg.com/maplibre-gl@3.6.2/dist/maplibre-gl.js'></script>

    <script src='https://kit.fontawesome.com/d7179d63a4.js' crossorigin='anonymous'></script>
    <meta http-equiv='Content-Security-Policy' content='upgrade-insecure-requests'>
</head>

<body>
    <div id='map'></div>

    <button id='info-button'>
        ?
    </button>
    <div id="spots-wrap">
        <div id="spots-counter-all2">
        </div>
    </div>

    <div id="spots-counter-all">
        <p>Už máme</p>
        <h3 id="spots-number"></h3>
        <p>spotů</p>
    </div>
    <button id='button-remove'>
        <i class='fa-solid fa-xmark'></i>
    </button>
    <section id='buttons-all'>

        <button id='button-list' class='button2'>
            <i class="fa-solid fa-list-ul"></i>
        </button>
        <button class='button-add' id='button-add-third'>
            <i class='fa-solid fa-plus'></i>
        </button>
        <button class='button-add' id='button-add-first'>
            <i class='fa-solid fa-plus'></i>
        </button>
        <button class='button-add' id='button-add-second'>
            <i class='fa-solid fa-check'></i>
        </button>
        <button id='button-logout' class='button2'>
            <i class='fa-solid fa-right-from-bracket'></i>
        </button>
    </section>
    <div id='popup-all' class='popup-all'> <!-- add form popup-->
    </div>
    <div id='popup-all2' class='popup-all'>
    </div>
    <div id='popup-all3' class='popup-all'> <!-- Logout popup-->
    </div>
    <div id='popup-all4' class='popup-all'>
    </div>
    <div id='popup-all5' class='popup-all'>
    </div>
    <div id='popup-all6' class='popup-all'>
    </div>
    <div id='popup-all7' class='popup-all'>
    </div>
    <div id='popup-all8' class='popup-all'> <!--user didnt get access to google drive-->
    </div>
    <div id='popup' class='popup'>

        <form id='add-form' method="POST" action="add-spot.php" enctype="multipart/form-data">
            <input type='file' accept='image/jpg, image/png, image/jpeg' id='fotka' name='fotka' hidden>
            <label for="fotka" id="fotka_label" class="fotka_label">Nahrát fotku</label><br>
            <span id="file-chosen">No file chosen</span>
            <input type='text' id='nazev' name='nazev' class='input-text' placeholder='Název spotu' required>
            <p id="form-full-name"></p>
            <textarea id='popis' name='popis' class='input-text' placeholder='Popisek'></textarea>
            <input type='checkbox' id='vyhlidka' name='vyhlidka' value='vyhlidka'>
            <label for='vyhlidka'>Vyhlídka</label><br>
            <input type='checkbox' id='rybnik' name='rybnik' value='rybnik'>
            <label for='rybnik'>U vody</label><br>
            <input type='checkbox' id='ohniste' name='ohniste' value='ohniste'>
            <label for='ohniste'>Ohniště</label><br>
            <input type='checkbox' id='zricenina' name='zricenina' value='zricenina'>
            <label for='zricenina'>Zřícenina</label><br>
            <input type='checkbox' id='pristresek' name='pristresek' value='pristresek'>
            <label for='pristresek'>Přístřešek</label><br>

            <input id='form-submit' type='submit' value='Přidat spot'>
        </form>
    </div>

    <div id='popup3' class='popup'>
        <p>
            Opravdu se chceš odhlásit?
        </p>
        <a href="logout.php" class="no-decoration"><button class="button-login" id="main-button-signout">
                Odhlásit se
            </button></a>
    </div>
    <div id='popup4' class='popup'>
        <div id="help-header">
            <h2>
                "
            </h2>
            <h2>
                i know a spot
            </h2>
            <h2>
                "
            </h2>
        </div>
        <p class="popup4-p">
            Ahoj zkuřko, vytvořil jsem tuhle stránku, abychom si mohli mezi sebou posdílet naše oblíbený spoty. Ať už
            preferuješ veselou cigaretku ej kej ej špeka nebo máš radši bóník, snad si tady najdeš nějaký nový hezký
            místečko ;)
        </p>
        <p class="popup4-p2">
            Kdybys mi chtěl přispět na chod webu nebo na špeka, tak můžeš sem 1850160013/3030 děkuju posílám lásku:3
        </p>
        <h3><i class="fa-solid fa-cannabis"></i> TIP <i class="fa-solid fa-cannabis"></i></h3>
        <p class="popup4-p">Pokud jsi na mobilu, tak si můžeš přidat stránku na plochu. Tím pádem až někdy narazíš na
            novej super spot, nemusíš hledat stránku ve vyhledávači a stačí kliknout na ikonu aplikace na mobilu.</p>
        <h3><i class="fa-solid fa-cannabis"></i> Nejde ti přidat spot? <i class="fa-solid fa-cannabis"></i></h3>
        <p class="popup4-p">
            Na některých mobilech kvůli nedostatečný ramce bohužel né vždycky funguje nahrání obrázku
            skrz fotoaparát. Nicméně pokud vložíš fotku z galerie, mělo by to normálně fungovat.
        </p>
        <p class="popup4-p2">
            Pokud bys měl jakýkoliv problémy s čímkoliv, tak mi je neváhej napsat na <i>a.auzky@gmail.com</i>
        </p>
        <a id="popup4-end" href="https://www.freeprivacypolicy.com/live/3bad88fd-c8fc-4e1d-9903-f0d06a8e15b6">Privacy
            Policy
        </a>
    </div>
    <div id='popup5' class='popup'>
        <h2 id="popup5-nick">
            Moje spoty
        </h2>
        <div id="popup5-container">
        </div>
    </div>
    <div id='popup6' class='popup'>
        <form id='nick-form' method="POST" action="signup-oauth.php" enctype="multipart/form-data">
            <p class="nick-h">
                Zvol si svoji přezdívku
            </p>
            <input type='text' id='nick' name='nick' class='input-text' placeholder='např. Ema Smotaná' required>

            <p id="<?= $_SESSION['nick-taken'] ?>">Takhle se tu už někdo jmenuje</p>

            <input id='nick-submit' type='submit' value='Budiž'>
        </form>
    </div>
    <div id='popup7' class='popup'>
        <p id="error-message">Takhle se tu už někdo jmenuje</p>
    </div>
    <div id='loader-all'>
        <div id='loader'></div>
    </div>
    <div id='information-allM'>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src='js/functions.js'></script>
    <script src='js/check-login.js'></script>
    <script src='js/map.js'></script>
    <script src='js/liking-system.js'></script>
    <script src="js/jquery-image-upload-resizer.js"></script>
    <script src='js/google-login.js'></script>
    <script src="js/fb-login.js"></script>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
    <script>

    </script>
    <script>
        $(document).ready(function () {
            // bind 'myForm' (is an id of form) and provide a simple callback function 
            $("form-submit").click(function () {
                $.ajax({ url: "index.php" });
            });
        }); 
    </script>
    <script>
        /*IMAGE*/
        const actualBtn = document.getElementById('fotka');

        const fileChosen = document.getElementById('file-chosen');

        actualBtn.addEventListener('change', function () {
            fileChosen.textContent = this.files[0].name;
        });

        $('#fotka').imageUploadResizer({
            max_width: 1000, // Defaults 1000
            max_height: 1000, // Defaults 1000
            quality: 1, // Defaults 1
            do_not_resize: ['gif', 'svg'], // Defaults []
        });
        console.log('changed');
    </script>

    <script>
        /*if signed in show buttons*/
        let isLogged = false;
        <?php if (isset($_SESSION['user_id'])) { ?>

            buttonMySpots.style.visibility = 'visible';
            buttonLogout.style.visibility = 'visible';
            buttonAddAdd.style.display = 'inline-block';
            buttonAddLogin.style.display = 'none';
            isLogged = true;
            console.log('logged in');

        <?php } ?>                     

    </script>
</body>

</html>