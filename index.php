<?php
session_start();

if (!isset($_SESSION['nick-taken'])) {
    $_SESSION['nick-taken'] = "already-taken-not";
}

?>
<?php if (isset($_POST['submit'])): ?>
    <script>console.log('commented')</script>
<?php endif; ?>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <div id="raining"></div>
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
    <button id="button-rain" class="button2">
        <i class="fa-solid fa-cloud-rain" id="icon-rain"></i>
        <i class="fa-solid fa-sun" id="icon-sun"></i>
    </button>
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

        <form id='add-form' method="POST" action="/spot/AddSpot.php" enctype="multipart/form-data">
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
    <!--<div class='information-all'>
            <div class='information-al'>
                <div class="information-all-L" id="spot-${spot_id}">
                <span class='spot-like-text' id="number-likes-${spot_id}">${likes}</span>
                    <a href='#' onclick="like(${spot_id}, ${likes});" id="like-${spot_id}"><i class="fa-regular fa-heart like-false like "></i></a>
                    <a href='#' onclick="unlike(${spot_id}, ${likes});" id="unlike-${spot_id}"><i class="fa-solid fa-heart like-true like"></i></a>
    
                    <h2>${name}</h2>
                    <p class='author author-${author}'>${author}</p>
                    <div class='icons'>
                        <i class='fa-solid fa-mountain icon-${vyhlidka}' title='Vyhlídka'></i>
                        <i class='fa-solid fa-water icon-${rybnik}' title='U vody'></i>
                        <i class='fa-solid fa-fire icon-${ohniste}' title='Ohniště'></i>
                        <i class='fa-solid fa-chess-rook icon-${zricenina}' title='Zřícenina'></i>
                        <i class='fa-solid fa-umbrella icon-${pristresek}' title='Přístřešek'></i>
                    </div>      
                    <textarea class='description description-${description}_' readonly>${description}</textarea>      
                </div>
                <div class="information-all-R">
                    <img class='spot-image' src='${imageSRC}' alt></img>
                </div>
            </div>
            <div class="comments-all">
                <h3>
                    Komentáře
                </h3>
                <div class="comments" id="comments-${spot_id}">
     
                </div>
            </div>
            <form class="comments-form" id="comment-form" onsubmit="return ajax_call_comment()">
                <input type="hidden" name="spot_id" id="comment_spot_id" value="40">
                <textarea id='koment' name='koment' class='comment-form-text' placeholder='' required></textarea>
                <button type='submit' value="" id="submit"name="submit" class="button-send-comment"><i class="fa-solid fa-paper-plane comment-send"></i></button>
            </form>
        </div>-->

    <div id='popup3' class='popup'>
        <p>
            Opravdu se chceš odhlásit?
        </p>
        <a href="/user/Logout.php" class="no-decoration"><button class="button-login" id="main-button-signout">
                Odhlásit se
            </button></a>
    </div>
    <!--<img src onrerror="alert('hacked')"/>-->
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
        <form id='nick-form' method="POST" action="user/SignUpOAuth.php" enctype="multipart/form-data">
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

    <script src='js/cookie.js'></script>
    <script src='js/check-login.js'></script>
    <script src='js/map.js'></script>
    <script src='js/check-spot.js'></script>
    <script src="js/jquery-image-upload-resizer.js"></script>
    <script src='js/google-login.js'></script>
    <script src="js/fb-login.js"></script>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
    <script>

    </script>
    <script>

        $(document).ready(function () {
            console.log("Document ready");
            // hide loading
            $('#loader-all').hide();
            // bind 'myForm' (is an id of form) and provide a simple callback function 
            $("form-submit").click(function () {
                $.ajax({ url: "index.php" });
            });
        });
    </script>
    <script>/*
$('#comment-form').submit(function (e) {
e.preventDefault();
var post_data = $('#comment-form').serialize();
$.post('comment/CommentSpot.php', post_data, function (data) {
console.log('sent data comment: '+post_data);
});
});*/
        function ajax_call_comment() {

            let data = new FormData();
            let comment_text = document.getElementById("koment").value;
            document.getElementById("koment").value = "";
            if(comment_text == ""){
                comment_text = document.getElementById("komentM").value;
                document.getElementById("komentM").value = "";
            }
            //comment_text = DOMPurify.sanitize(comment_text);
            data.append("comment_spot_id", document.getElementById("comment_spot_id").value);
            data.append("koment", comment_text);
            console.log(comment_text);

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "comment/CommentSpot.php");
            xhr.onload = function () {
                console.log(this.response);
                if (this.response == 'SignInFirst') {
                    window.location.href = "user/SignUp.php";
                }
                else {
                    let sent_data = JSON.parse(this.response);

                    let comment_id = sent_data[5].split(':')[1].split('}')[0];
                    console.log(comment_id);

                    let commentContainer = document.querySelectorAll(`#comments${sent_data[0]}, #commentsM${sent_data[0]}`);
                    console.log(commentContainer);
                    let date_readable = changeDate(sent_data[3]);
                    for (let b = 0; b < commentContainer.length; b++) {
                        commentContainer[b].innerHTML +=
                            `
                            <div class="comment comment-${comment_id}" id="comment-${comment_id}">
                                <div class="comment-bubble">
                                    <p class="comment-author">${sent_data[2]}</p><p class="comment-date">${date_readable}</p><br>
                                    <p class="comment-text">${sent_data[4]}</p><br>
                                    <a class="comment-delete" href="" onclick="return deleteComment(${comment_id});">Odstranit komentář</a>
                                </div>
                            </div>
                            `
                        commentContainer[b].scrollTop = commentContainer[b].scrollHeight;
                    }
                }
            };
            console.log(data);
            xhr.send(data);

            return false;

        }

        function deleteComment(comment_id) {
            let data = new FormData();
            data.append("delete_comment_id", comment_id);

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "comment/DeleteComment.php");
            xhr.onload = function () {
                console.log(this.response);

                $('.comment-' + comment_id).hide();
                //commentContainer[b].scrollTop = commentContainer[b].scrollHeight;

                /*let commentContainer = document.querySelectorAll(`#comments${sent_data[0]}, #commentsM${sent_data[0]}`);
                console.log(commentContainer);
                for (let b = 0; b < commentContainer.length; b++) {
                    commentContainer[b].innerHTML +=
                        `
                            <div class="comment">
                                <div class="comment-bubble">
                                    <p class="comment-author">${sent_data[2]}</p><p class="comment-date">${sent_data[3]}</p><br>
                                    <p class="comment-text">${sent_data[4]}</p><br>
                                    <a class="comment-delete" href='/../comment/DeleteComment.php?delete_comment_id=${sent_data[5]}\'>Odstranit komentář</a>
                                </div>
                            </div>
                            `
                    commentContainer[b].scrollTop = commentContainer[b].scrollHeight;
                }
            }*/
            };
            console.log(data);
            xhr.send(data);

            return false;
        }
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