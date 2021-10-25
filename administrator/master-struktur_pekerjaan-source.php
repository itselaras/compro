<?php
	include("includes/connection.php");
	$tb = $_GET["tb"];
	$data = array();
	$sql = "SELECT ".$tb." FROM tb_struktur_".$tb;
	$query = mysql_query($sql);
	while($result = mysql_fetch_array($query))
	{
		array_push($data, $result[$tb]);
	}
	echo json_encode($data);
?>