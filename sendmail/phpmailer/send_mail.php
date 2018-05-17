<html>
<body>

<?php
/*
	//if(confirmDate()==true){
	if(true){
		sendMail();
	}else{
		echo "pas encore";
	}
	confirmDate();
	function confirmDate(){
		$zero1=date("Y-m-d");
		$firstday = date('Y-m-01', strtotime($zero1)); 
		$lastday = date('Y-m-d', strtotime("$firstday +1 month -1 day"));
		return strtotime($zero1)==strtotime($lastday);
	}
	function sendMail(){
	   $mailto = $_POST['mailto'];
	   $mailto = "aurelien.turpin1@gmail.com";
	   echo "mailto = ".$mailto;
	   echo "<br/>";
	   $mailSub = $_POST['mailsubject'];
	   $mailMsg = $_POST['mailbody'];
	   $mailSub = "test";
	   $mailMsg = "ceci est un test";
	   require 'PHPMailer-master/PHPMailerAutoload.php';
	   $mail = new PHPMailer();
	   $mail ->IsSmtp();
	   $mail ->SMTPDebug = 1;
	   $mail ->SMTPAuth = true;
	   $mail ->SMTPSecure = 'ssl';
	   $mail ->Host = "smtp.mailtrap.io";
	   $mail ->Port = 465; // or 587
	   $mail ->IsHTML(true);
	   $mail ->Username = "81d16705d3878e"; //gmail address
	   $mail ->Password = "07baf54b219250";//password
	   $mail ->SetFrom("bonjour@gmail.com");//gmail address
	   $mail ->Subject = $mailSub;
	   $mail ->Body = $mailMsg;
	   $mail ->AddAddress($mailto);

	   echo "<br/>";
	   if(!$mail->Send())
	   {
		   echo "Mail Not Sent";
	   }
	   else
	   {
		   echo "Mail Sent";
	   }
	}
	*/
?>

<?php
/**
 * This example shows sending a message using PHP's mail() function.
 */
//Import the PHPMailer class into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';
//Create a new PHPMailer instance
$mail = new PHPMailer;

$mail->IsSMTP();                           // telling the class to use SMTP
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = "mail.yourdomain.com"; // set the SMTP server
$mail->Port       = 2525;                    // set the SMTP port
$mail->Username   = "81d16705d3878e"; // SMTP account username
$mail->Password   = "07baf54b219250";        // SMTP account password


//Set who the message is to be sent from
$mail->setFrom('from@example.com');
//Set an alternative reply-to address
//$mail->addReplyTo('replyto@example.com', 'First Last');
//Set who the message is to be sent to
$mail->addAddress('aurelien.turpin1@gmail.com');
//Set the subject line
$mail->Subject = 'PHPMailer mail() test';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
?>
</body>
</html>