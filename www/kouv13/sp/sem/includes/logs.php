<?php
$meaning = "";
$message = "";
if (isset($_GET['chng'])) {
    //zmena hesla
    switch ($_GET['chng']) {
        case "1":
            $meaning = "success";
            $message = "Úspěšně jsi změnil heslo!";
            break;
        case "2":
            $meaning = "warning";
            $message = "Původní heslo není správné!";
            break;
        case "3":
            $meaning = "danger";
            $message = "Heslo nejde změnit. Zkus to znovu.";
            break;
        case "4":
            $meaning = "warning";
            $message = "Hesla nesplňují podmínky. Buď jsou prázdná, nebo se nová nerovnají, nebo je nové stejné jako staré.";
            break;
    }
} else if (isset($_GET['can'])) {
    //zruseni rezervace
    switch ($_GET['can']) {
        case "1":
            $meaning = "success";
            $message = "Úspěšné zrušení termínu. Kdykoliv můžeš nové termíny zarezervovat znovu.";
            break;
        case "2":
            $meaning = "danger";
            $message = "Chyba při rušení termínu.";
            break;
    }
} else if (isset($_GET['checkout'])) {
    //checkout
    switch ($_GET['checkout']) {
        case "1":
            $meaning = "success";
            $message = "Úspěšné zarezervování!";
            break;
        case "2":
            $meaning = "danger";
            $message = "Nevybral jsi žádné časy!";
            break;
        case "3":
            $meaning = "danger";
            $message = "Chyba při rezervaci.";
            break;
        case "4":
            $meaning = "warning";
            $message = "Chyba při dokončení.";
            break;
    }
} else if (isset($_GET['signup'])) {
    //signup
    switch ($_GET['signup']) {
        case "1":
            $meaning = "success";
            $message = "Úspěšná registrace! V dolní části můžes rezervovat termíny svých nových sportovních zážitků. Těšíme se na tebe!";
            break;
        case "2":
            $meaning = "warning";
            $message = "Tento email už používáme!";
            break;
        case "3":
            $meaning = "danger";
            $message = "Chyba při registraci.";
            break;
        case "4":
            $meaning = "warning";
            $message = "Chyba při dokončení.";
            break;
        case "5":
            $meaning = "warning";
            $message = "Heslo nesplňuje podmínky: 8 charakterů, minimálně 1 velké a 1 malé písmeno, číslo a speciální charakter.";
            break;
    }
} else if (isset($_GET['login'])) {
    //login
    switch ($_GET['login']) {
        case "1":
            $meaning = "success";
            $message = "Vítej zpět!";
            break;
        case "2":
            $meaning = "warning";
            $message = "Chybné heslo nebo email.";
            break;
        case "3":
            $meaning = "warning";
            $message = "Chyba při zadávání údajů.";
            break;
        case "4":
            $meaning = "warning";
            $message = "Chyba při dokončení.";
            break;
    }
} else if (isset($_GET['kick'])) {
    //kick
    switch ($_GET['kick']) {
        case "5":
            $meaning = "danger";
            $message = "Do uživatelské části mají přístup jen členové!";
            break;
    }
    switch ($_GET['kick']) {
        case "6":
            $meaning = "danger";
            $message = "Do administrátorské části mají přístup jen zaměstnanci!";
            break;
    }
} else if (isset($_GET['addf'])) {
    //add field
    switch ($_GET['addf']) {
        case "1":
            $meaning = "success";
            $message = "Úspěšně přidaná hala!";
            break;
        case "2":
            $meaning = "warning";
            $message = "Chyba při přidávání.";
            break;
    }
} else if (isset($_GET['adds'])) {
    //add sport
    switch ($_GET['adds']) {
        case "1":
            $meaning = "success";
            $message = "Úspěšně přidaný sport!";
            break;
        case "2":
            $meaning = "warning";
            $message = "Chyba při přidávání.";
            break;
        case "3":
            $meaning = "warning";
            $message = "Tento sport je již přidaný.";
            break;
    }
} else if (isset($_GET['edit'])) {
    //edit field
    switch ($_GET['edit']) {
        case "1":
            $meaning = "success";
            $message = "Úspěšně upravená hala!";
            break;
        case "2":
            $meaning = "warning";
            $message = "Chyba při upravování.";
            break;
    }
} else if (isset($_GET['delf'])) {
    //delete field
    switch ($_GET['delf']) {
        case "1":
            $meaning = "success";
            $message = "Úspěšně smazaná hala!";
            break;
        case "2":
            $meaning = "warning";
            $message = "Chyba při mazání.";
            break;
    }
}
if (!empty($message)) {
?>

    <div class="alert alert-<?php echo $meaning; ?> mb-5" role="alert">
        <?php echo $message; ?>
    </div>


<?php }
