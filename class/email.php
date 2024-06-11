<?php 

class Email {
 
    public function sendEmail($subject, $message) {
        $users = new UsersDB();
        $userID = $_SESSION['user_id'];
        $to = $users->findBy('user_id', $userID)[0]['email'];
        $headers = array(
            'MIME-version' => '1.0',
            'Content-Type' => 'text/html;charset=UTF-8',
            'From' => 'jiripoisel@gmail.com',
            'Reply-To' => 'jiripoisel@gmail.com'
          ); 
        return mail($to, $subject, $message, $headers);

    }
}

$email = new Email();

?>
