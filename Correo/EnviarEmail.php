
<?php

function smtpmailer($to, $host, $port, $from, $password, $from_name, $subject, $message) {
//error_reporting(E_ALL);
error_reporting(E_STRICT);
global $error;
require_once('class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail             = new PHPMailer();

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = $host; // SMTP server
$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the server
$mail->Host       = $host; // sets the SMTP server
$mail->Port       = $port;                    // set the SMTP port for the GMAIL server
$mail->Username   = $from; // SMTP account username
$mail->Password   = $password;        // SMTP account password
$mail->SetFrom($from, $from_name);
$mail->Subject    = $subject;
$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->AddAddress($to, $to);
$mail->AddCC($from);
//        ----- -------       //

$mail->CharSet = 'utf-8';
$mail->ConfirmReadingTo;
$mail->AddEmbeddedImage('../img/b-logo.png', 'imagen','../img/b-logo.png','base64','image/png');
$message.=" <img src= '../img/b-logo.png' alt=''  />  ";
$mail->AltBody = strip_tags(str_replace('<br />',"\n",    html_entity_decode($message)));
$mail->Body = '<html><head></head><body>'.$message.'</body></html>';
$mail->ConfirmReadingTo;   
$mail->Body = $mail->WrapText($mail->Body, $mail->WordWrap);

  if (!$mail->Send()) {
        echo "<script language='JavaScript'> alert('error al enviar') 
                     //     location.href = '../Recuperar_Password.php';  exit();
                            </script> ";
    } else {
        echo "<script language='JavaScript'> alert( 'Mensaje enviado') 
                          location.href = '../login.php';  exit();
                            </script> ";
    }
}

?>


