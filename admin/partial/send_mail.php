<?php
// 1) Include Composer’s autoloader
require_once __DIR__ . '/../../vendor/autoload.php';
// if (file_exists(dirname(__DIR__) . '../../vendor/autoload.php')) {
//     require_once(dirname(__DIR__) . '../../vendor/autoload.php');
// }

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


function send_mail($usermail , $subject = '' , $body = '' , $name = ''){
    $mail = new PHPMailer(true);
    try {
        // 2) SMTP configuration
        $mail->isSMTP();
        $mail->Host       = smtp_host;
        $mail->SMTPAuth   = true;
        $mail->Username   = smtp_username;
        $mail->Password   = smtp_password;
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;
    
        // 3) Set email headers & body
        $mail->setFrom(sent_from_mail, sent_from);
    
        // 3) Set email headers & body
        $mail->addAddress($usermail, $name);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;
        //$mail->AltBody = 'This is the plain-text version of the email.';
    
        $mail->send();
        return  true ;
    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
    }

}
