<?php 
    session_start();
    include("includes/connection.php");
    include("includes/function.php");
    $auth = authByID($_POST["auth"]);
    if($auth == 0)
    {
        if($_GET["act"] == "sub-pekerjaan")
        {
            $sql = "SELECT id,sub_pkr FROM tb_sub_jenis_pekerjaan WHERE id_jns_pkr='".$_POST["id"]."'";
            $query = mysql_query($sql); 
            while($result = mysql_fetch_array($query))   
            {
                $data[$result["id"]] = $result["sub_pkr"];
            }     
            echo json_encode($data);
        }
        if($_GET["act"] == "hapus")
        {
            $sql = "DELETE FROM tb_lowongan WHERE id='".$_POST["id"]."'";
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