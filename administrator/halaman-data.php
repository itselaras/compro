<?php
	include("includes/connection.php");
	include("includes/function.php");
	$data[] = array();
	if($_POST["field"] == "kontak")
	{
		$sql = "SELECT * FROM tb_kontak WHERE id='".$_POST["id"]."'";
		$query = mysql_query($sql);
		$result = mysql_fetch_array($query);
		$data["tipeOffice"] = tipeOffice($result["tipe_office"]);
		$data["kodeTipeOffice"] = $result["tipe_office"];
		$data["namaOffice"] = $result["nama_office"];
		$data["alamat"] = $result["alamat"];
		$data["telepon"] = $result["telepon"];
		$data["website"] = $result["website"];
		$data["email"] = $result["email"];
	} else
	{
		$sql = "SELECT ".$_POST["field"]." FROM tb_konten_halaman";
		$query = mysql_query($sql);
		$result = mysql_fetch_array($query);
		if($result[$_POST["field"]] == "")
		{
			$data["view"] = "Tidak ada data.";
		} else
		{
			$data["view"] = "<p align='justify'>".$result[$_POST["field"]]."</p>";
		}
		$data["ckeditor"] = $result[$_POST["field"]];
	}
	echo json_encode($data);		
?>