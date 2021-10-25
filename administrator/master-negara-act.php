<?php 
    session_start();
    include("includes/connection.php");
    include("includes/function.php");
    $auth = authByID($_POST["auth"]);
    if($auth == 0)
    {
        if($_GET["act"] == "tambah")
        {
            $sql = "INSERT INTO tb_negara(negara) VALUES('$_POST[negara]')";
            $query = mysql_query($sql);            
        }
        if($_GET["act"] == "edit")
        {
            $sql = "UPDATE tb_negara SET negara='$_POST[negara]' WHERE id='$_POST[id]'";
            $query = mysql_query($sql);            
        }
        if($_GET["act"] == "hapus")
        {
            $sql = "DELETE FROM tb_negara WHERE id='$_POST[id]'";
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