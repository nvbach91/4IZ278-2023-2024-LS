<?php session_status() === PHP_SESSION_NONE ? session_start() : null; ?>
<?php

require_once dirname(__DIR__) . "/db/User.php";
require "email-config.php";

function sendMail($to, $type) {
    global $headers;

    if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    switch ($type) {
        case "accountCreate":
            $subject = "Vitej v systemu";
            $message = "Ahoj,<br><br>
            tvuj ucet byl uspesne vytvoren. Pro prihlaseni klikni <a href='https://eso.vse.cz/~mald16/sp/'>zde</a>.<br><br>
            S pozdravem,<br>
            Aplikace mald16-sp";
            break;
        case "invite":
            $subject = "Pozvanka do organizace";
            $message = "Ahoj,<br><br>
            byl jsi pozvan do organizace.<br><br>
            Pro praci v systemu se prihlas nebo registruj <a href='https://eso.vse.cz/~mald16/sp/'> primo v aplikaci</a>.<br><br>
            S pozdravem,<br>
            Aplikace mald16-sp";
            break;
        case "editSong":
            $subject = "Zmena ve skladbe";
            $message = "Ahoj,<br><br>
            probehly zmeny v tve skladbe. Vice se dozvis primo v <a href='https://eso.vse.cz/~mald16/sp/'>aplikaci</a>.<br><br>
            S pozdravem,<br>
            Aplikace mald16-sp";
            break;
        case "deleteSong":
            $subject = "Skladba byla smazana";
            $message = "Ahoj,<br><br>
            tva skladba byla smazana. Vice se dozvis primo v <a href='https://eso.vse.cz/~mald16/sp/'>aplikaci</a>.<br><br>
            S pozdravem,<br>
            Aplikace mald16-sp";
            break;
        case "createSong":
            $subject = "Nova skladba";
            $message = "Ahoj,<br><br>
            byla vytvorena nova skladba. Vice se dozvis primo v <a href='https://eso.vse.cz/~mald16/sp/'>aplikaci</a>.<br><br>
            S pozdravem,<br>
            Aplikace mald16-sp";
            break;
        case "deleteUserFromOrg":
            $subject = "Byl jsi odebran z organizace";
            $message = "Ahoj,<br><br>
            byl jsi odebran z organizace. Vice se dozvis primo v <a href='https://eso.vse.cz/~mald16/sp/'>aplikaci</a>.<br><br>
            S pozdravem,<br>
            Aplikace mald16-sp";
            break;
    }

    $notifOptIn = User::getNotifOptIn($to);
    if ($notifOptIn == 1) {
        try {
            mail($to, $subject, $message, $headers);
        } catch (Exception $e) {
            return false;
        }
    }
}
