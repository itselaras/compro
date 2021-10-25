<?php
	include("includes/connection.php");
	$data = array();
	$sql = "SELECT negara FROM tb_negara";
	$query = mysql_query($sql);
	while($result = mysql_fetch_array($query))
	{
		array_push($data, $result["negara"]);
	}
	echo json_encode($data);
?>