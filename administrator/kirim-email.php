<?php 
    include("includes/connection.php");
    // for ($i=0; $i < 5000000; $i++) { 
    //     $a++;
    // }
    // require "../phpmailer/PHPMailerAutoload.php";
    require "../phpmailer/class.phpmailer.php";
    require "../phpmailer/class.smtp.php";
    $sqlEmail = "SELECT email,password_email FROM tb_email";
    $queryEmail = mysql_query($sqlEmail);
    $resultEmail = mysql_fetch_array($queryEmail);
    if(isset($_POST["email"]))
    {
    	$result["email"] = $_POST["email"];
    	$result["nama_lengkap"] = $_POST["email"];
    } else
    {
	    $sql = "SELECT nama_lengkap,email FROM tb_pelamar WHERE id='".$_POST["id"]."'";
	    $query = mysql_query($sql);
	    $result = mysql_fetch_array($query);    	
    }

	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->SMTPDebug = 0;
	$mail->Debugoutput = 'html';
	$mail->Port = 465;
	$mail->SMTPSecure = 'ssl';
	$mail->SMTPAuth = true;
	$mail->Host = 'iix51.rumahweb.com';
	// $mail->Host = "smtp.mail.yahoo.com";
	$mail->Username = $resultEmail["email"];
	$mail->Password = $resultEmail["password_email"];
	$mail->setFrom($resultEmail["email"], 'Selaras Mitra Integra');
	$mail->addReplyTo($resultEmail["email"], 'Selaras Mitra Integra');
	$mail->addAddress($result["email"], $result["nama_lengkap"]);
	$mail->Subject = 'Informasi Selaras Mitra Integra';
	$mail->msgHTML('<table bgcolor="#f1f1f1" width="100%" height="100%" align="center" style="border-collapse:collapse" border="0" cellspacing="0" cellpadding="0"><tbody><tr align="center"><td valign="top"><table bgcolor="#f1f1f1" height="20" style="border-collapse:collapse" border="0" cellspacing="0" cellpadding="0"><tbody><tr></tr></tbody></table><table cellspacing="0" cellpadding="0" bgcolor="#ffffff" style="text-align:left; border: 2px solid #cecece;"><tbody><tr><td height="15" style="border-top:none;border-bottom:none;border-left:none;border-right:none"></td></tr><tr><td width="15" style="border-top:none;border-bottom:none;border-left:none;border-right:none"></td><td width="568" valign="top" style="font-size:83%;border-top:none;border-bottom:none;border-left:none;border-right:none;font-size:13px;font-family:arial,sans-serif;color:#222222;line-height:18px"><table><tbody><tr><td width="68"><img src="../img/smi-logo.png" border="0" style="display:block" height="40" class="CToWUd"></td><td width="500" valign="bottom" style="padding-left: 10px; font-size:20px;font-family:arial,sans-serif;color:#777777;font-weight:bold;">Selaras Mitra Integra<hr style="border: 0; height: 1px; background: #cecece; margin-bottom: 3px; margin-top: 3px;"></td></tr></tbody></table></td><td width="15" style="border-top:none;border-bottom:none;border-left:none;border-right:none"></td></tr><tr><td height="15" style="border-top:none;border-bottom:none;border-left:none;border-right:none"></td></tr><tr><td width="15" style="border-top:none;border-bottom:none;border-left:none;border-right:none"></td><td width="568" valign="top" style="font-size:83%;border-top:none;border-bottom:none;border-left:none;border-right:none;font-size:13px;font-family:arial,sans-serif;color:#222222;line-height:18px">'.$_POST["pesan"].'</td><td width="15" style="border-top:none;border-bottom:none;border-left:none;border-right:none"></td></tr><tr><td height="15" style="border-top:none;border-bottom:none;border-left:none;border-right:none"></td></tr><tr><td width="15" style="border-top:none;border-bottom:none;border-left:none;border-right:none"></td><td width="568" style="font-size:11px;font-family:arial,sans-serif;color:#777777;border-top:none;border-bottom:none;border-left:none;border-right:none">Email ini tidak dapat menerima balasan. Untuk informasi lainnya, kunjungi <a href="http://www.selarasmitraintegra.com" style="text-decoration:none;color:#4d90fe" target="_blank"><span style="color:#4d90fe">Selaras Mitra Integra</span></a>.</td><td width="15" style="border-top:none;border-bottom:none;border-left:none;border-right:none"></td></tr><tr><td height="15" style="border-top:none;border-bottom:none;border-left:none;border-right:none"></td></tr></tbody></table><table bgcolor="#f1f1f1" height="20" style="border-collapse:collapse" border="0" cellspacing="0" cellpadding="0"><tbody><tr></tr></tbody></table></td></tr></tbody></table>');

	if (!$mail->send()) 
	{
	    echo "Mailer Error: " . $mail->ErrorInfo;
	} else 
	{
	    echo "Message sent!";
	}
?>