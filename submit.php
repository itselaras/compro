<?php 
	// You need to add server side validation and better error handling here
	session_start();
	include("administrator/includes/connection.php");
	include("administrator/includes/function.php");
 
	$data = array();

	$keyInsert = '';

	if ($_GET['key'] == 'foto') {
		$keyInsert = 1;
	}else if ($_GET['key'] == 'ijazah') {
		$keyInsert = 2;
	}else if ($_GET['key'] == 'transkrip') {
		$keyInsert = 3;
	}else if ($_GET['key'] == 'referensi') {
		$keyInsert = 4;
	}
	 
	if($_GET['status'] == 'reg')
	{  
		$error = false;
		$files = array();

		$uploaddir = "img/pelamar/". $_SESSION["pelamarID"]."/";
		if (!file_exists($uploaddir)) {
		    mkdir($uploaddir, 0777, true);
		}

		$sqlPrivate = "SELECT * FROM tb_lampiran WHERE id_pelamar='".$_SESSION["pelamarID"]."' AND type = '".$keyInsert."'";
		$queryPrivate = mysql_query($sqlPrivate);
		$countPrivate = mysql_num_rows($queryPrivate);

		if ($countPrivate>0) {
			$resultPrivate = mysql_fetch_array($queryPrivate);

			$file = basename($resultPrivate['dir_file']);

			// unlink($file);

			if (!unlink($resultPrivate['dir_file'])){
				$error = true;
			}
		}

		foreach($_FILES as $file)
		{
			$target_file = $uploaddir . basename($file["name"]);
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

			// Allow certain file formats
			if($imageFileType != "pdf" && 
			   $imageFileType != "jpg" && 
			   $imageFileType != "jpeg"&& 
			   $imageFileType != "png" && 
			   $imageFileType != "bmp" &&
			   $imageFileType != "gif" &&
			   $imageFileType != "xls" &&
			   $imageFileType != "xlsx"&&
			   $imageFileType != "doc" &&
			   $imageFileType != "docx") {
			    $error = true;
			}

			if(move_uploaded_file($file['tmp_name'], $uploaddir . $file["name"]))

			{
				$files[] = $uploaddir . $file["name"];

				$sqlSelect = "SELECT * FROM tb_lampiran WHERE id_pelamar='".$_SESSION["pelamarID"]."' AND type = '".$keyInsert."'";
				$querySelect = mysql_query($sqlSelect);
				if (mysql_num_rows($querySelect)<=0) {
					$sql = "INSERT INTO tb_lampiran (id_pelamar, type, dir_file) 
					VALUES ('".$_SESSION["pelamarID"]."', '".$keyInsert."', '".$uploaddir.$file["name"]."')";
				}else{
					$sql = "UPDATE tb_lampiran SET dir_file = '".$uploaddir.$file["name"]."' WHERE id_pelamar = '".$_SESSION["pelamarID"]."' AND type = '".$keyInsert."'";
				}

				$query = mysql_query($sql);
			}
			else
			{
			    $error = true;
			}
		}
		$data = ($error) ? array('error' => 'There was an error uploading your files') : array('files' => $files);
	}
	else
	{
		$data = array('success' => 'Lampiran telah diganti', 'formData' => $_POST);
	}
	 
	echo json_encode($data);
 
?>