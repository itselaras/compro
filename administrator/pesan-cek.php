<?php
	include("includes/connection.php");
	$data = array();
	$sql = "SELECT COUNT(id) AS banyak FROM tb_pesan WHERE status_baca='0'";
	$query = mysql_query($sql);
	$result = mysql_fetch_array($query);
	$data["banyak"] = $result["banyak"];

	$sql = "SELECT COUNT(id) AS notif FROM tb_pesan WHERE status_notif='0'";
	$query = mysql_query($sql);
	$result = mysql_fetch_array($query);
	$data["notif"] = $result["notif"];

	$sql = "UPDATE tb_pesan SET status_notif='1'";
	$query = mysql_query($sql);

	echo json_encode($data);
?>