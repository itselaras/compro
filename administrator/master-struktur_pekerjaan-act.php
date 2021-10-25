<?php 
    session_start();
    include("includes/connection.php");
    include("includes/function.php");
    $auth = authByID($_POST["auth"]);
    if($auth == 0)
    {
        $tb = $_GET["tb"];
        if($_GET["act"] == "tambah")
        {
            $sql = "INSERT INTO tb_struktur_".$tb."(".$tb.") VALUES('".$_POST["dataValue"]."')";
            $query = mysql_query($sql);            
        }
        if($_GET["act"] == "edit")
        {
            $sql = "UPDATE tb_struktur_".$tb." SET ".$tb."='".$_POST["dataValue"]."' WHERE id='".$_POST["id"]."'";
            $query = mysql_query($sql);            
        }
        if($_GET["act"] == "hapus")
        {
            $sql = "DELETE FROM tb_struktur_".$tb." WHERE id='".$_POST["id"]."'";
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