<?php
	session_start();
	include("administrator/includes/connection.php");
	$expire=time()+60*60*24*1;
	$remove=time()-60*60*24*1;
	setcookie("username", "$_POST[username]", $expire);
	if($_POST["remember"]==1)
	{
		setcookie("password", "$_POST[password]", $expire);
	} else
	{
		setcookie("password", "", $remove);
	}
	$sql = "SELECT id,username,type FROM tb_user WHERE username='$_POST[username]' AND password='$_POST[password]'";
	$query = mysql_query($sql);
	$result = mysql_num_rows($query);
	if($result>0)
	{
		$query_update = mysql_query($sql);
		$result_update = mysql_fetch_array($query_update);
		$ubahLogin = mysql_query("UPDATE tb_user SET last_login=NOW() WHERE id='$result_update[id]'");
		$sql_pelamar = "SELECT id FROM tb_pelamar WHERE id_user='".$result_update["id"]."'";
		$query_pelamar = mysql_query($sql_pelamar);
		$result_pelamar = mysql_fetch_array($query_pelamar);
		$_SESSION["loginID"] = $result_update["id"];
		$_SESSION["pelamarID"] = $result_pelamar["id"];
		$_SESSION["typeID"] = $result_update["type"];
		$_SESSION["userID"] = $result_update["username"];
		$data["auth"] = $_POST["url"];			
	} else
	{
		$data["auth"] = 0;
	}
	echo json_encode($data);
?>