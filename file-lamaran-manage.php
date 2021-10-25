<?php 
	session_start();
	include("administrator/includes/connection.php");
	include("administrator/includes/function.php");

	$auth = authByID($_POST["auth"]);

	if($auth == 0){
		$dir_pelamar = "img/pelamar/".$_POST['auth'];

		if (!file_exists($dir_pelamar)) {
		    mkdir($dir_pelamar, 0777, true);
		}

		echo $_POST["auth"];
		echo $_POST["file_id"];
		echo $_POST["file_lampiran"];
	}
?>