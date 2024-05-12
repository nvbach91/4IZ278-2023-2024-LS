<?php

function sendInviteEmail($to, $orgName, $returnTo) {
    global $headers;
    $subject = "Pozvánka do organizace";
    $message = "Ahoj,\n\n
    
                byl jsi pozván do organizace $orgName.\n\n
                
                Pro práci v systému se přihlaš nebo registruj přímo v aplikaci.\n\n
                
                S pozdravem,\n
                Systém";

    mail("davidmalasek@post.cz", $subject, $message, $headers);

    header("Location: $returnTo");
    exit();
}
