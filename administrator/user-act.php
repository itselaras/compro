<?php 
    session_start();
    include("includes/connection.php");
    include("includes/function.php");
    $auth = authByID($_POST["auth"]);
    if($auth == 0)
    {
        if($_GET["act"] == "reset")
        {
            $acak = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $string = "";
            for ($i=0; $i < 5; $i++) { 
                $pos = rand(0,strlen($acak)-1);
                $string .= $acak{$pos};
            }
            $sql = "UPDATE tb_user SET password=md5('".$string."') WHERE id='".$_POST["id"]."'";
            $result = mysql_query($sql);
            if($result)
            {
                echo "Password baru:<br><strong>".$string."</strong>";                
            }
        }
        if($_GET["act"] == "hapus")
        {
            $sql = "DELETE FROM tb_user WHERE id='".$_POST["id"]."'";
            $query = mysql_query($sql);
        }
    }
?>