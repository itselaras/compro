<?php
	include("includes/connection.php");
	$sql = "UPDATE tb_lowongan SET STATUS='0' WHERE DATE(NOW()) NOT BETWEEN awal_berlaku AND akhir_berlaku";
	$query = mysql_query($sql);
?>