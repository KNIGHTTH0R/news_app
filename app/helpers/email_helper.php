<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('send_verification_mail')){
    function send_verification_mail( $email ,$hash) {

        $to         = $email; // Send email to our user
        $subject    = 'Signup | Verification'; // Give the email a subject 
        $message    = '

        Thanks for signing up!
        Your account has been created,
        
        Please click this link to activate your account and set your password:
        http://localhost/news_app/users/verify?email='.$email.'&hash='.$hash.'
         
        '; // Our message above including the link

        return smtpmailer($to, $subject, $message);
    }  
}

if ( ! function_exists('smtpmailer')){   
    
    function smtpmailer($to, $subject, $message) { 

        require $_SERVER['DOCUMENT_ROOT'].'news_app/app/libraries/PHPMailer/PHPMailerAutoload.php';
        
        $mail = new PHPMailer;

        $mail->IsSMTP(); // enable SMTP
        //$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
        $mail->Username = "newsappcrossover@gmail.com";
        $mail->Password = "crossover";
        $mail->SetFrom("newsappcrossover@gmail.com");
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->AddAddress($to);
        
         if(!$mail->Send()) {
            return false;
         } else {
            return true;
         }
    }
}