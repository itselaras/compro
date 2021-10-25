<?php
	session_start();
	include("administrator/includes/connection.php");
	include("administrator/includes/function.php");
	require 'phpmailer/PHPMailerAutoload.php';


	$action = $_POST["action"];

	switch ($action) {
		case 'insert':

			$sqlID = "SELECT a.id FROM tb_user a LEFT JOIN tb_pelamar b ON b.id_user = a.id WHERE b.email = '$_POST[email]'";
            $queryID = mysql_query($sqlID);
            $resultID = mysql_num_rows($queryID);

			if($resultID <= 0) {
				$sql = "INSERT INTO tb_user (username, password, type, created_at) VALUES ('$_POST[username]', md5('$_POST[password]'), '2', NOW() )";
				if(mysql_query($sql)){
					$sqlGetId = "SELECT id FROM tb_user WHERE username = '$_POST[username]' AND password = md5('$_POST[password]')";
		            $queryGetId = mysql_query($sqlGetId);
		            $resultGetId = mysql_fetch_array($queryGetId);

					$sqlData = "INSERT INTO tb_pelamar (id_user, email) VALUES ('$resultGetId[id]', '$_POST[email]')";
					if(mysql_query($sqlData))
					{
						echo "success";
						session_destroy();
					}else{
						echo "failed";
					}
				}else{
					echo "failed";
				}
			}else{
				echo "incorrect";
			}
			break;

		case 'update':

			$auth = authByID($_POST["auth"]);

			if($auth == 0){

				$sqlID = "SELECT a.id FROM tb_user a LEFT JOIN tb_pelamar b ON b.id_user = a.id WHERE b.email = '$_POST[email]' AND b.id_user != '$_POST[auth]'";
	            $queryID = mysql_query($sqlID);
	            $resultID = mysql_num_rows($queryID);

				if($resultID <= 0) {
					$sqlID = "SELECT password FROM tb_user WHERE id='$_POST[auth]'";
	                $queryID = mysql_query($sqlID);
	                $resultID = mysql_fetch_array($queryID);

					if($resultID['password'] == md5($_POST['passwordLama'])) {
						$sql = "UPDATE tb_user SET username='$_POST[username]'";
						if($_POST['password']!='') {
							$sql .= ", password=md5('$_POST[password]')";
						}
						$sql .= ", updated_by='$_POST[auth]', updated_at=NOW() WHERE id='$_POST[auth]'";
						if(mysql_query($sql)){
							$sqlData = "UPDATE tb_pelamar SET email='$_POST[email]' WHERE id_user='$_POST[auth]'";
							if(mysql_query($sqlData)){
								echo "success";
								session_destroy();
							}else{
								echo "Update data <strong>gagal</strong>.<br>Mohon coba kembali.";
							}
						}else{
							echo "Update data <strong>gagal</strong>.<br>Mohon coba kembali.";
						}
					}else{
						echo "<strong>Password Lama</strong> tidak cocok.<br>Silahkan periksa kembali.";
					}
				}else{
					echo "<strong>Email</strong> telah terpakai.";
				}
			}
			break;

		case 'forgot':

			$character_set_array = array();
		    $character_set_array[] = array('count' => 7, 'characters' => 'abcdefghijklmnopqrstuvwxyz');
		    $character_set_array[] = array('count' => 1, 'characters' => '0123456789');
		    $temp_array = array();
		    foreach ($character_set_array as $character_set) {
		        for ($i = 0; $i < $character_set['count']; $i++) {
		            $temp_array[] = $character_set['characters'][rand(0, strlen($character_set['characters']) - 1)];
		        }
		    }
		    shuffle($temp_array);
		    $new_password =  implode('', $temp_array);

			$sqlID = "SELECT a.id, a.username, b.email FROM tb_user a LEFT JOIN tb_pelamar b ON b.id_user = a.id WHERE b.email = '$_POST[email]'";
            $queryID = mysql_query($sqlID);
            $resultID = mysql_num_rows($queryID);

			if($resultID > 0) {
				$resultUser = mysql_fetch_array($queryID);
				$sql = "UPDATE tb_user SET password=md5('$new_password') WHERE id='$resultUser[id]'";
				if(mysql_query($sql)){

					$sqlEmail = "SELECT email,password_email FROM tb_email";
				    $queryEmail = mysql_query($sqlEmail);
				    $resultEmail = mysql_fetch_array($queryEmail); 

					$mail = new PHPMailer;

					$mail->isSMTP();
					$mail->Host = 'iix51.rumahweb.com';
					// $mail->Host = "smtp.mail.yahoo.com";
					$mail->SMTPAuth = true;
					$mail->Username = $resultEmail["email"];
					$mail->Password = $resultEmail["password_email"];
					$mail->SMTPSecure = 'ssl';
					$mail->Port = 465;

					$mail->From = $resultEmail["email"];
					$mail->FromName = 'Selaras Mitra Integra';
					$mail->addReplyTo($resultEmail["email"], 'Selaras Mitra Integra');

					$mail->WordWrap = 50;
					$mail->isHTML(true);

					$mail->addAddress($resultUser["email"], $resultUser["username"]);

					$mail->Subject = 'Selaras Mitra Integra: Password Account Information';
					$mail->msgHTML('<table bgcolor="#f1f1f1" width="100%" height="100%" align="center" style="border-collapse:collapse" border="0" cellspacing="0" cellpadding="0"><tbody><tr align="center"><td valign="top"><table bgcolor="#f1f1f1" height="20" style="border-collapse:collapse" border="0" cellspacing="0" cellpadding="0"><tbody><tr></tr></tbody></table><table cellspacing="0" cellpadding="0" bgcolor="#ffffff" style="text-align:left; border: 2px solid #cecece;"><tbody><tr><td height="15" style="border-top:none;border-bottom:none;border-left:none;border-right:none"></td></tr><tr><td width="15" style="border-top:none;border-bottom:none;border-left:none;border-right:none"></td><td width="568" valign="top" style="font-size:83%;border-top:none;border-bottom:none;border-left:none;border-right:none;font-size:13px;font-family:arial,sans-serif;color:#222222;line-height:18px"><table><tbody><tr><td width="68"><img src="img/smi-logo.png" border="0" style="display:block" height="40" class="CToWUd"></td><td width="500" valign="bottom" style="padding-left: 10px; font-size:20px;font-family:arial,sans-serif;color:#777777;font-weight:bold;">Selaras Mitra Integra<hr style="border: 0; height: 1px; background: #cecece; margin-bottom: 3px; margin-top: 3px;"></td></tr></tbody></table></td><td width="15" style="border-top:none;border-bottom:none;border-left:none;border-right:none"></td></tr><tr><td height="15" style="border-top:none;border-bottom:none;border-left:none;border-right:none"></td></tr><tr><td width="15" style="border-top:none;border-bottom:none;border-left:none;border-right:none"></td><td width="568" valign="top" style="font-size:83%;border-top:none;border-bottom:none;border-left:none;border-right:none;font-size:13px;font-family:arial,sans-serif;color:#222222;line-height:18px">Username: <b>'.$resultUser["username"].'</b></td><td width="15" style="border-top:none;border-bottom:none;border-left:none;border-right:none"></td></tr><tr><td width="15" style="border-top:none;border-bottom:none;border-left:none;border-right:none"></td><td width="568" valign="top" style="font-size:83%;border-top:none;border-bottom:none;border-left:none;border-right:none;font-size:13px;font-family:arial,sans-serif;color:#222222;line-height:18px">Password: <b>'.$new_password.'</b></td><td width="15" style="border-top:none;border-bottom:none;border-left:none;border-right:none"></td></tr><tr><td height="15" style="border-top:none;border-bottom:none;border-left:none;border-right:none"></td></tr><tr><td width="15" style="border-top:none;border-bottom:none;border-left:none;border-right:none"></td><td width="568" style="font-size:11px;font-family:arial,sans-serif;color:#777777;border-top:none;border-bottom:none;border-left:none;border-right:none">Email ini tidak dapat menerima balasan. Untuk informasi lainnya, kunjungi <a href="http://www.selarasmitraintegra.com" style="text-decoration:none;color:#4d90fe" target="_blank"><span style="color:#4d90fe">Selaras Mitra Integra</span></a>.</td><td width="15" style="border-top:none;border-bottom:none;border-left:none;border-right:none"></td></tr><tr><td height="15" style="border-top:none;border-bottom:none;border-left:none;border-right:none"></td></tr></tbody></table><table bgcolor="#f1f1f1" height="20" style="border-collapse:collapse" border="0" cellspacing="0" cellpadding="0"><tbody><tr></tr></tbody></table></td></tr></tbody></table>');

					if(!$mail->send()) {
					    echo 'Email untuk informasi account tidak terkirim. Silahkan hubungi admin.';
					    echo 'Email informasi account error: ' . $mail->ErrorInfo;
					} else {
					    echo 'Informasi perubahan password telah dikirim ke email ('.($_POST["email"]).').';
					}
				}else{
					echo "Perubahan password gagal.";
				}
			}else{
				echo "Email tidak terdaftar.";
			}
			break;

		case 'send-email':
			$messageContent = '
				<table bgcolor="#f1f1f1" width="100%" height="100%" align="center" style="border-collapse:collapse" border="0" cellspacing="0" cellpadding="0">
					<tbody>
						<tr align="center">
							<td valign="top">
								<table bgcolor="#f1f1f1" height="20" style="border-collapse:collapse" border="0" cellspacing="0" cellpadding="0">
									<tbody>
										<tr></tr>
									</tbody>
								</table>
								<table cellspacing="0" cellpadding="0" bgcolor="#ffffff" style="text-align:left; border: 2px solid #cecece;">
									<tbody>
										<tr>
											<td height="15" style="border-top:none;border-bottom:none;border-left:none;border-right:none"></td>
										</tr>
										<tr>
											<td width="15" style="border-top:none;border-bottom:none;border-left:none;border-right:none"></td>
											<td width="568" valign="top" style="font-size:83%;border-top:none;border-bottom:none;border-left:none;border-right:none;font-size:13px;font-family:arial,sans-serif;color:#222222;line-height:18px">
												<table>
													<tbody>
														<tr>
															<td width="68"><img src="img/smi-logo.png" border="0" style="display:block" height="40" class="CToWUd"></td>
															<td width="500" valign="bottom" style="padding-left: 10px; font-size:20px;font-family:arial,sans-serif;color:#777777;font-weight:bold;">Selaras Mitra Integra<hr style="border: 0; height: 1px; background: #cecece; margin-bottom: 3px; margin-top: 3px;"></td>
														</tr>
													</tbody>
												</table>
											</td>
											<td width="15" style="border-top:none;border-bottom:none;border-left:none;border-right:none"></td>
										</tr>
										<tr>
											<td height="15" style="border-top:none;border-bottom:none;border-left:none;border-right:none"></td>
										</tr>
										<tr>
											<td width="15" style="border-top:none;border-bottom:none;border-left:none;border-right:none"></td>
											<td width="568" valign="top" style="font-size:83%;border-top:none;border-bottom:none;border-left:none;border-right:none;font-size:13px;font-family:arial,sans-serif;color:#222222;line-height:18px">'.$_POST["message"].'</td>
											<td width="15" style="border-top:none;border-bottom:none;border-left:none;border-right:none"></td>
										</tr>
										<tr>
											<td height="15" style="border-top:none;border-bottom:none;border-left:none;border-right:none"></td>
										</tr>
										<tr>
											<td width="15" style="border-top:none;border-bottom:none;border-left:none;border-right:none"></td>
											<td width="568" valign="top" style="font-size:83%;border-top:none;border-bottom:none;border-left:none;border-right:none;font-size:13px;font-family:arial,sans-serif;color:#222222;line-height:18px">Username: <b>'.$_POST["username"].'</b></td>
											<td width="15" style="border-top:none;border-bottom:none;border-left:none;border-right:none"></td>
										</tr>';

										if ($_POST["password"]!='') {
											$messageContent .= '
											<tr>
												<td width="15" style="border-top:none;border-bottom:none;border-left:none;border-right:none"></td>
												<td width="568" valign="top" style="font-size:83%;border-top:none;border-bottom:none;border-left:none;border-right:none;font-size:13px;font-family:arial,sans-serif;color:#222222;line-height:18px">Password: <b>'.$_POST["password"].'</b></td>
												<td width="15" style="border-top:none;border-bottom:none;border-left:none;border-right:none"></td>
											</tr>';
										}

										$messageContent .= '
										<tr>
											<td width="15" style="border-top:none;border-bottom:none;border-left:none;border-right:none"></td>
											<td width="568" valign="top" style="font-size:83%;border-top:none;border-bottom:none;border-left:none;border-right:none;font-size:13px;font-family:arial,sans-serif;color:#222222;line-height:18px">Email: <b>'.$_POST["email"].'</b></td>
											<td width="15" style="border-top:none;border-bottom:none;border-left:none;border-right:none"></td>
										</tr>
										<tr>
											<td height="15" style="border-top:none;border-bottom:none;border-left:none;border-right:none"></td>
										</tr>
										<tr>
											<td width="15" style="border-top:none;border-bottom:none;border-left:none;border-right:none"></td>
											<td width="568" style="font-size:11px;font-family:arial,sans-serif;color:#777777;border-top:none;border-bottom:none;border-left:none;border-right:none">Email ini tidak dapat menerima balasan. Untuk informasi lainnya, kunjungi <a href="http://www.selarasmitraintegra.com" style="text-decoration:none;color:#4d90fe" target="_blank"><span style="color:#4d90fe">Selaras Mitra Integra</span></a>.</td><td width="15" style="border-top:none;border-bottom:none;border-left:none;border-right:none"></td></tr><tr><td height="15" style="border-top:none;border-bottom:none;border-left:none;border-right:none"></td>
										</tr>
									</tbody>
								</table>
								<table bgcolor="#f1f1f1" height="20" style="border-collapse:collapse" border="0" cellspacing="0" cellpadding="0">
									<tbody>
										<tr></tr>
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			';

			$mail = new PHPMailer;

			$mail->isSMTP();
			$mail->Host = 'iix51.rumahweb.com';
			$mail->SMTPAuth = true;
			$mail->Username = 'hrd@selarasmitraintegra.com';
			$mail->Password = 'hrdsmi16888';
			$mail->SMTPSecure = 'ssl';
			$mail->Port = 465;

			$mail->From = 'hrd@selarasmitraintegra.com';
			$mail->FromName = 'Selaras Mitra Integra';
			$mail->addReplyTo('hrd@selarasmitraintegra.com', 'Selaras Mitra Integra');

			$mail->WordWrap = 50;
			$mail->isHTML(true);

			$mail->addAddress($_POST["email"], $_POST["username"]);
			$mail->Subject = 'Selaras Mitra Integra: Account Information';
			$mail->msgHTML($messageContent);

			if(!$mail->send()) {
			    echo 'Email untuk informasi account tidak terkirim.';
			    echo 'Email informasi account error: ' . $mail->ErrorInfo;
			} else {
			    echo 'Informasi account telah dikirim ke email ('.($_POST["email"]).').';
			}
			break;
		
		default:
			# code...
			break;
	}
?>