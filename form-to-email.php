<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;
  //Load Composer's autoloader
  require 'vendor/autoload.php';

  //get data from form
  $name = $_POST['name'];
  $visitor_email = $_POST['email'];
  $message = $_POST['message'];
  $subject = $_POST['subject'];
  $phone = $_POST['phone'];

  //preparing mail content
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
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.abv.bg';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'z3robot@abv.bg';                     //SMTP username
    $mail->Password   = '34482555';                           //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;                        //SMTP password
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
    //Recipientss
    $mail->setFrom($visitor_email, $name);         //Add visitors email and name $$
    $mail->addAddress('z3robot@abv.bg', 'Notary 229');     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = "Съобщение от сайта: " . $subject;   //subject of the send email
    $mail->Body    = $messagecontent;                     //Content message of the send email
      
    $mail->send();
    echo '<center><h1><b>Съобщението е изпратено успешно. Ще бъдете прехвърлени на главната страница след 5 секунди.</b></h1></center>';
    header("refresh: 5, url = index.html");
  }
  catch (Exception $e) 
  {
    echo '<center><h1><b>Съобщението НЕ е изпратено успешно. Опитайте отново или изберете някои от другите методи за връзка с нас. <br> Прехвърляне след 7 секунди.</h1></b></center>';
    header("refresh: 7, url = contact-us.html");
    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
?> 