
<?php

function smtpmailer($to, $from, $password, $from_name, $subject, $message) {
//error_reporting(E_ALL);
error_reporting(E_STRICT);

require_once('class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail             = new PHPMailer();


$mail->IsSMTP(); // telling the class to use SMTP
try {
$mail->Host       = "smtp.gmail.com"; // SMTP server
$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the server
$mail->Host       = "smtp.gmail.com"; // sets the SMTP server
$mail->Port       = 465;                    // set the SMTP port for the GMAIL server
$mail->Username   = $from; // SMTP account username
$mail->Password   = $password;        // SMTP account password
$mail->SetFrom($from, $from_name);
$mail->AddReplyTo("jesuspelayob@gmail.com","jesus");
$mail->Subject    = $subject;
$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$mail->MsgHTML($message);
$mail->AddAddress($to, "Cliente");
//if(!$mail->Send()) {
//  echo "Mailer Error: " . $mail->ErrorInfo;
//} else {
//  echo "Message sent!";
//}

$mail->Send();
 echo "Message Sent OK</p>\n";
} catch (phpmailerException $e) {
  echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
  echo $e->getMessage(); //Boring error messages from anything else!
}

}
?>


