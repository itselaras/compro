<?php 
    session_start();
    include("includes/connection.php");
    include("includes/function.php");
    $auth = authByID($_POST["auth"]);
    if($auth == 0)
    {
        if($_GET["act"] == "tambah")
        {
            $sql = "INSERT INTO tb_jurusan(jurusan) VALUES('$_POST[jurusan]')";
            $query = mysql_query($sql);            
        }
        if($_GET["act"] == "edit")
        {
            $sql = "UPDATE tb_jurusan SET jurusan='$_POST[jurusan]' WHERE id='$_POST[id]'";
            $query = mysql_query($sql);            
        }
        if($_GET["act"] == "hapus")
        {
            $sql = "DELETE FROM tb_jurusan WHERE id='$_POST[id]'";
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