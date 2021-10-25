<?php
	session_start();
	session_destroy();
	$data["url"] = "index?status=logout";
	echo json_encode($data);
?>