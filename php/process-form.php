
<?php
require "vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$nameFrom = $_ENV['NAME'];
$emailFrom = $_ENV['MAIL_USERNAME'];
$senderEmail = $_POST['email'];
$senderName = $_POST['name'];
$senderSubject = $_POST['subject'];
$senderMessage = $_POST['message'];



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);
$mail2 = new PHPMailer(true);

// $mail->SMTPDebug = SMTP::DEBUG_SERVER;

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = $_ENV['MAIL_HOST'];
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = $_ENV['MAIL_PORT'];;

$mail->Username = $_ENV['MAIL_USERNAME'];
$mail->Password = $_ENV['MAIL_PASSWORD'];

$mail->setFrom($emailFrom, $nameFrom);
$mail->addAddress($emailFrom, $nameFrom);

$mail->Subject = $senderSubject;

$message = '<html><body>';
$message .= '<table rules="all" style="border:1px solid #666;width:300px;" cellpadding="10">';
$message .= ($senderName) ? "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . $senderName . "</td></tr>" : '';
$message .= ($senderEmail) ?"<tr><td><strong>Email:</strong> </td><td>" . $senderEmail . "</td></tr>" : '';
$message .= ($senderMessage) ?"<tr><td><strong>Message:</strong> </td><td>" . $senderMessage . "</td></tr>" : '';

$message .= "</table>";
$message .= "</body></html>";

$mail->Body="
Name:$senderName<br/>
Email: $senderEmail<br/>
Suburb: $senderSubject<br/>
Message: $senderMessage";
$mail->MsgHTML($message);

$send_email = $mail->send();
      
echo ($send_email) ? 'success' : 'error';

$mail2->isSMTP();
$mail2->SMTPAuth = true;

$mail2->Host = $_ENV['MAIL_HOST'];
$mail2->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail2->Port = $_ENV['MAIL_PORT'];

$mail2->Username = $_ENV['MAIL_USERNAME'];
$mail2->Password = $_ENV['MAIL_PASSWORD'];

$mail2->setFrom($emailFrom, $nameFrom);
$mail2->addAddress($senderEmail, $senderName);

$mail2->Subject = "Thankyou for contacting " . $senderName;

$message2 = '<html><body>';
$message2 = '<p>Thankyou for contacting Harsh Jain. I will respond to your query as soon as possible. Below we have attached the copy of contact form you have filled.</p><br/>';
$message2 .= '<table rules="all" style="border:1px solid #666;width:300px;" cellpadding="10">';
$message2 .= ($senderName) ? "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . $senderName . "</td></tr>" : '';
$message2 .= ($senderEmail) ?"<tr><td><strong>Email:</strong> </td><td>" . $senderEmail . "</td></tr>" : '';
$message2 .= ($senderMessage) ?"<tr><td><strong>Message:</strong> </td><td>" . $senderMessage . "</td></tr>" : '';

$message2 .= "</table>";
$message2 .= "</body></html>";

$mail2->Body="
Name:$senderName<br/>
Email: $senderEmail<br/>
Suburb: $senderSubject<br/>
Message: $senderMessage";
$mail2->MsgHTML($message2);

$mail2->send();
?>


