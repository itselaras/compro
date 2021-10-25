<?php 
    session_start();
    include("includes/connection.php");
    include("includes/function.php");
    $auth = authByID($_POST["auth"]);
    if($auth == 0)
    {
        if($_GET["act"] == "tambah")
        {
            $sql = "INSERT INTO tb_kota(id_bagian,kota) VALUES('$_POST[id]','$_POST[kota]')";
            echo $sql;
            $query = mysql_query($sql);            
        }
        if($_GET["act"] == "edit")
        {
            $sql = "UPDATE tb_kota SET kota='$_POST[kota]' WHERE id='$_POST[id]'";
            $query = mysql_query($sql);            
        }
        if($_GET["act"] == "hapus")
        {
            $sql = "DELETE FROM tb_kota WHERE id='$_POST[id]'";
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