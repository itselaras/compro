<?php 
    session_start();
    include("includes/connection.php");
    include("includes/function.php");
    $auth = authByID($_POST["auth"]);
    if($auth == 0)
    {
        if($_GET["act"] == "tambah")
        {
            $sql = "INSERT INTO tb_negara_bagian(id_negara,bagian) VALUES('$_POST[id]','$_POST[provinsi]')";
            echo $sql;
            $query = mysql_query($sql);            
        }
        if($_GET["act"] == "edit")
        {
            $sql = "UPDATE tb_negara_bagian SET bagian='$_POST[provinsi]' WHERE id='$_POST[id]'";
            $query = mysql_query($sql);            
        }
        if($_GET["act"] == "hapus")
        {
            $sql = "DELETE FROM tb_negara_bagian WHERE id='$_POST[id]'";
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