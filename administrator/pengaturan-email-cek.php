<?php 
    require "../phpmailer/class.phpmailer.php";
    require "../phpmailer/class.smtp.php";

	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->SMTPDebug = 0;
	$mail->Port = 465;
	$mail->SMTPSecure = 'ssl';
	$mail->SMTPAuth = true;
	$mail->Host = 'iix51.rumahweb.com';
	// $mail->Host = "smtp.mail.yahoo.com";
	$mail->Username = $_POST["email"];
	$mail->Password = $_POST["password"];
	$mail->setFrom($_POST["email"], 'Selaras Mitra Integra');
	$mail->addAddress($_POST["email"], 'Test Mail');
	$mail->Subject = 'Test Mail';
	$mail->msgHTML('Test Mail');

	if (!$mail->send()) 
	{
	    echo json_encode(0);
	} else 
	{
	    echo json_encode(1);
	}
?>