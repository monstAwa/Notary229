<?php

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  //Load Composer's autoloader
  require 'vendor/autoload.php';

  //Get data from form
  $name = $_POST['name'];
  $visitor_email = $_POST['email'];
  $message = $_POST['message'];
  $subject = $_POST['subject'];
  $phone = $_POST['phone'];

  //Preparing mail content
  $messagecontent = "Име: <b>$name</b>" . 
            "<br><br>Телефон: <b>$phone</b>" . 
            "<br><br>Основание: <b>$subject</b>" . 
            "<br><br>Съобщение: <b>$message</b>" . 
            "<br><br>Имейл: <b>$visitor_email </b><br>";

  //Create an instance; passing `true` enables exceptions
  $mail = new PHPMailer(true);
  $mail->CharSet = 'UTF-8';
  try {
    //Server settings

    //Line for debugging if needed
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;

    $mail->isSMTP();                                       //Send using SMTP
    $mail->Host       = 'smtp.abv.bg';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                              //Enable SMTP authentication
    $mail->Username   = 'z3robot@abv.bg';                  //SMTP username
    $mail->Password   = '34482555';                        //SMTP password
    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;       //SMTP Encryption
    $mail->Port       = 465;                               //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
    //Recipients
    $mail->setFrom('z3robot@abv.bg', 'Mailer');         //Add visitors email and name $$
    $mail->addAddress('z3robot@abv.bg', 'Notary 229');  //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = "Съобщение от сайта: " . $subject;   //subject of the send email
    $mail->Body    = $messagecontent;                     //Content message of the send email
      
    $mail->send();
    header("Location: sent.html");
  }
  catch (Exception $e) 
  {
    header("Location: not-sent.html");
    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
?> 