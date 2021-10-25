<?php
	session_start();
	include("includes/connection.php");
	include("includes/function.php");
	$auth = authByID($_POST["auth"]);
	if($auth == 0)
	{
		if(isset($_POST["userType"]))
		{
			$updateType = ",type='$_POST[userType]'";
		} else
		{
			$updateType = "";		
		}
		$sql = "UPDATE tb_user SET username='$_POST[username]',password=md5('$_POST[password]')".$updateType." WHERE id='$_POST[auth]'";
		if(mysql_query($sql))
		{
			echo "Update data berhasil. Anda akan kembali ke halaman login dalam ";
			session_destroy();
		} else {
			echo "Update data gagal.";
		}
	}
?>