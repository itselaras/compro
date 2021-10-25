<?php 
    session_start();
    include("includes/connection.php");
    include("includes/function.php");
    $auth = authByID($_POST["auth"]);
    if($auth == 0)
    {
        if($_GET["act"] == "hapus")
        {
            $gambar = mysql_fetch_array(mysql_query("SELECT lokasi FROM tbl_image WHERE id='".$_POST["id"]."'"));
            $dir = $gambar["lokasi"];
            unlink($dir);
            $sql = "DELETE FROM tbl_image WHERE id='$_POST[id]'";
            $query = mysql_query($sql);            
        }
    }
?>