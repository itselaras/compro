<?php 
    session_start();
    include("includes/connection.php");
    include("includes/function.php");
    $auth = authByID($_POST["auth"]);
    if($auth == 0)
    {
        if($_POST["field"] == "kontak")
        {
            if($_POST["action"] == "hapus")
            {
                $sql = "DELETE FROM tb_kontak WHERE id='".$_POST["id"]."'";
            } else
            {
                if($_POST["idEdit"] == "")
                {
                    $sql = "INSERT INTO tb_kontak(tipe_office,nama_office,alamat,telepon,email,website) VALUES('".$_POST["tipeOffice"]."','".$_POST["namaOffice"]."','".$_POST["alamat"]."','".$_POST["telepon"]."','".$_POST["email"]."','".$_POST["website"]."')";
                } else
                {
                    $sql = "UPDATE tb_kontak SET tipe_office='".$_POST["tipeOffice"]."',nama_office='".$_POST["namaOffice"]."',alamat='".$_POST["alamat"]."',telepon='".$_POST["telepon"]."',email='".$_POST["email"]."',website='".$_POST["website"]."' WHERE id='".$_POST["idEdit"]."'";            
                }                 
            }
        } else
        {
            $sqlCek = "SELECT * FROM tb_konten_halaman";
            $queryCek = mysql_query($sqlCek);
            $cekExist = mysql_num_rows($queryCek);
            if($cekExist == 0)
            {
                $sql = "INSERT INTO tb_konten_halaman(".$_POST["field"].") VALUES('$_POST[konten]')";
            } else
            {
                $sql = "UPDATE tb_konten_halaman SET ".$_POST["field"]."='$_POST[konten]'";            
            }
        }
        $query = mysql_query($sql);
    }
?>