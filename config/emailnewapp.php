<?php
require 'phpmailer/PHPMailerAutoload.php';
$mail = new PHPMailer;
$date = date("Y-m-d H:i:s");
$mail->isSMTP();
$mail->Host = 'smtp.mandom.co.id';
$mail->SMTPAuth = true;
$mail->SMTPAutoTLS = false; 
$mail->Port = 25; 
$mail->Username = "mandom.application@mandom.co.id";                 // SMTP username
$mail->Password = "Mandom.2021";
$mail->SMTPSecure = 'non';			 
$mail->setFrom('mandom.application@mandom.co.id', 'E-Form');
$mail->addReplyTo('', '');
if ($appdivisi !="-" && $appdivisi !="" && $appdivisi !=" "){
	$exe=mysqli_query($con,"SELECT Name Nama,Email FROM tb_user 
	WHERE KDDivision ='$appdivisi' And KDPosition ='$appposisi'"); 
	while(@$datakirim =mysqli_fetch_array($exe)){
		//$mail->AddAddress("{$datakirim['Email']}","{$datakirim['Nama']}");  //tujuan email
		//$mail->AddAddress("arief.akbar@mandom.co.id");  //tujuan email
		$mail->AddAddress("ferry.augustian@mandom.com");  //tujuan email
		$mail->AddAddress("rian.husen@mandom.com");  //tujuan email
		$mail->Body = "
		Dear {$datakirim['Nama']},<br><br>
		Please ".$Confirm." ".$WorkFlowMenu." Request <br>
		Request No : ".$id."<br>
		Remark Action : ".$remark."<br><br> 
		Use following link to open from : <br><br>
		http://mid95/e-form/dist/index.php?button=".$page."&id=".$id."<br><br>
		
		Best Reqards,<br><br>
		
		PT. Mandom Indonesia Tbk";
	}	
}

		
$mail->Subject = "Waitting Approval ".$WorkFlowMenu;
$mail->isHTML(true);
// Send email
if(!$mail->send()){
	echo ("<script>console.log('PHP : Message could not be sent');</script>");
	echo 'Mailer Error: ' . $mail->ErrorInfo;
}else{
	echo ("<script>console.log('PHP : Message has been sent');</script>");
}
	
			








?>