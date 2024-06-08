<?php 

require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../authentication/AuthUtils.php";


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function SendOrderMail($email, $orderId, $cart): bool{

    

    $totalPrice = 0;

    foreach($cart as $item){

        $totalPrice += (int)$item->quantity * (float)$item->book->price;
    }

    $message = "Thank you for your order (" . $orderId . ")\nOrder summary:\r\n";
    foreach($cart as $item){
        $message .= "Name: " . $item->book->title . " Quantity: " . $item->quantity . " Price per piece: " . $item->book->price . "\r\n";
    }
    $message .= "Total price: " . $totalPrice;
    $message = wordwrap($message,70,"\r\n");

    $subject = "BookBookGo order: " . $orderId . "";


    try{
        $mail = new PHPMailer(true);

        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        

        $mail->setFrom('chav07@vse.cz', 'Mailer');
        $mail->addAddress($email);     //Add a recipient
        $mail->isHTML(false);
        $mail->Subject = $subject;
        $mail->Body = $message;
       
        $mail->send();
        return true;
    }
    catch(Exception $e){
        exit("Couldn't send an email". $e->getMessage());
    }


    return true;
}
?>