<?php 
    session_start();
    include("includes/connection.php");
    include("includes/function.php");
    $auth = authByID($_POST["auth"]);
    if($auth == 0)
    {
        if($_GET["act"] == "hapus")
        {
            $sql = "DELETE FROM tb_pelamar WHERE id='$_POST[id]'";
            $query = mysql_query($sql);          
            if($query)
            {
                echo "0";
            } else
            {
                echo "1";
            }
        }
    }
?>