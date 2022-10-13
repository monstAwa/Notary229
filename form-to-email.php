<?php
if(!isset($_POST['submit']))
{
	//This page should not be accessed directly. Need to submit the form.
	echo "Грешка; трябва да изпратите формата";
}
$name = $_POST['name'];
$visitor_email = $_POST['email'];
$message = $_POST['message'];
$subject = $_POST['subject'];
$phone = $_POST['phone'];

//Validate first
if(empty($name)||empty($visitor_email)) 
{
    echo "Име и имейл са задължителни.";
    exit;
}

if(IsInjected($visitor_email))
{
    echo "Невалиден имейл.";
    exit;
}

$email_from = 'nikoalaaa@gmail.com';//<== update the email address
$email_subject = "Нов имейл от сайта: $subject. \n";
$email_body = "Получено е ново съобщение от $name. Телефон: $phone. \n".
    "Съобщението е:\n $message".
    
$to = "nikoalaaa@gmail.com";//<== update the email address
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $visitor_email \r\n";
//Send the email!
//header("refresh:3;url=index.html");

//mail($to, $email_subject, $email_body, $headers);
if(mail($to, $email_subject, $email_body, $headers)){
  echo "Съобщението е изпратено успешно. Ще бъдете прехвърлени на главната страница след 3 секунди.";
  header("refresh:3; url=index.html");
}else{
  echo "Съобщението НЕ е изпратено успешно. Ще бъдете прехвърлени отново в страница Контакти след 5 секунди.";
  header("refresh:5; url=contact-us.html");
}

//done.


// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
   
?> 