<?php 
    session_start();
    include("includes/connection.php");
    include("includes/function.php");
    $auth = authByID($_POST["auth"]);
    if($auth == 0)
    {
        if($_GET["act"] == "hapus")
        {
            $sql_unlink = "SELECT file FROM tb_pengumuman_files WHERE id_pengumuman='".$_POST["id"]."'";
            $query_unlink = mysql_query($sql_unlink);
            while($unlink = mysql_fetch_array($query_unlink))
            {
                $dir = "../".$unlink["file"];
                unlink($dir);
            }
            $sql = "DELETE FROM tb_pengumuman WHERE id='".$_POST["id"]."'";
            $query = mysql_query($sql); 
        }
    }
?>