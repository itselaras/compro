<?php 
	session_start();
	include("administrator/includes/connection.php");
	include("administrator/includes/function.php");

	$sql = "INSERT INTO tb_pesan (`from`, `email`, `pesan`, `tanggal`) 
	VALUES ('$_POST[auth]', '$_POST[email]', '$_POST[message]', NOW());";
	if (mysql_query($sql)) {
		echo "success";
	}
?>