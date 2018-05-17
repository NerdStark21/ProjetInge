<html>
<body>

<?php
	header("Content-Type: text/html; charset=utf-8");
  
	require("smtp.php");
	echo "c'est moi";
	if(confirmDate()==true){
		
		sendMail();
	}else{
		echo "pas encore";
	}
	function confirmDate(){
		$zero1=date("Y-m-d");
		echo $zero1;
		$firstday = date('Y-m-01', strtotime($zero1)); 
		$lastday = date('Y-m-d', strtotime("$firstday +1 month -1 day"));
		echo $lastday;
		if(strtotime($zero1)==strtotime($lastday)){ 
			//echo "ok";
			return true;
		}else{
			//echo "non";
			return false;
		}
	}
	function sendMail(){
		$smtpserver = "ssl://smtp.gmail.com";//server qq
		$smtpserverport = 25;//port
		$smtpusermail = "username@gmail.com";//user
		$smtpemailto = $_POST["mailto"];//receiver
		$smtpuser = "username";//username
		$smtppass = "password";//Smtp code d'autorisation
		$mailsub = $_POST["mailsubject"];
		$mailBody = $_POST["mailbody"];
		$mailtype = "HTML";
		$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
		$smtp->debug = TRUE;//是否显示发送的调试信息
		$smtp->sendmail($smtpemailto, $smtpusermail, $mailsub, $mailBody, $mailtype);
		echo "Mail Sent.";
	}
?>

</body>
</html>