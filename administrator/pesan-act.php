<?php 
    session_start();
    include("includes/connection.php");
    include("includes/function.php");
    $auth = authByID($_POST["auth"]);
    if($auth == 0)
    {
        if($_GET["act"] == "update")
        {
            $sql = "UPDATE tb_pesan SET status_baca='1' WHERE id='".$_POST["id"]."'";
            $query = mysql_query($sql);            
        }
        if($_GET["act"] == "balas")
        {
            $sql = "UPDATE tb_pesan SET balas='".$_POST["pesan"]."',status_balas='1' WHERE id='".$_POST["id"]."'";
            $query = mysql_query($sql);            
        }
        if($_GET["act"] == "hapus")
        {
            $sql = "DELETE FROM tb_pesan WHERE id='".$_POST["id"]."'";
            $query = mysql_query($sql);            
        }
    }
?>