<?php 
    session_start();
    error_reporting(0);
    include("includes/connection.php");
    include("includes/function.php");
    $auth = authByID($_POST["auth"]);
    if($auth == 0)
    {
        if($_GET["act"] == "hapus")
        {
            $gambar = mysql_fetch_array(mysql_query("SELECT logo FROM tb_klien WHERE id='".$_POST["id"]."'"));
            $dir = "../".$gambar["logo"];
            unlink($dir);
            $sql = "DELETE FROM tb_klien WHERE id='".$_POST["id"]."'";
            if($query = mysql_query($sql))
            {
               echo "0";
            } else
            {
                echo "1";
            }
        }
    }
?>