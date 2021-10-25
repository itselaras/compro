<?php 
    session_start();
    include("includes/connection.php");
    include("includes/function.php");
    $auth = authByID($_POST["auth"]);
    if($auth == 0)
    {
        if($_GET["act"] == "filter")
        {
            $data = array();
            $sql = "SELECT * FROM tb_lowongan WHERE id='".$_POST["id"]."'";
            $query = mysql_query($sql);
            $result = mysql_fetch_array($query);
            $data["jenisKelamin"] = $result["syarat_jenis_kelamin"];
            $data["pendidikan"] = $result["syarat_pendidikan"];
            $data["ipk"] = $result["syarat_ipk"];
            $data["pengalaman"] = $result["syarat_pengalaman"];
            $data["jurusan"] = $result["syarat_jurusan"];
            $data["usia"] = $result["syarat_usia"];
            echo json_encode($data);
        }
        if($_GET["act"] == "update")
        {
            $sql = "UPDATE tb_lowongan SET syarat_jenis_kelamin=NULLIF('".$_POST["jenisKelamin"]."',''),syarat_pendidikan=NULLIF('".$_POST["pendidikan"]."',''),syarat_ipk=NULLIF('".$_POST["ipk"]."',''),syarat_pengalaman=NULLIF('".$_POST["pengalaman"]."',''),syarat_jurusan=NULLIF('".$_POST["jurusan"]."',''),syarat_usia=NULLIF('".$_POST["usia"]."','') WHERE id='".$_POST["id"]."'";
            // echo $sql;
            $query = mysql_query($sql);
        }
        if($_GET["act"] == "response")
        {
            $sql = "UPDATE tb_rekrutmen SET status='".$_POST["action"]."' WHERE id_lowongan='".$_POST["idLowongan"]."' AND id_pelamar='".$_POST["idPelamar"]."'";
            // echo $sql;
            $query = mysql_query($sql);
        }
        if($_GET["act"] == "accepted")
        {
            $data = array();
            $ke = array();
            $sql = "SELECT a.id_pelamar,b.nama_lengkap
                FROM tb_rekrutmen a 
                LEFT JOIN tb_pelamar b ON a.id_pelamar=b.id 
                WHERE a.id_lowongan='".$_POST["idLowongan"]."' AND a.status='1'
                ORDER BY b.nama_lengkap ASC";
            $query = mysql_query($sql);
            while ($result = mysql_fetch_array($query)) {
                array_push($data, $result["id_pelamar"]);
                array_push($ke, $result["nama_lengkap"]);
            }
            $sql = "SELECT MAX(konfirmasi_ke) AS ke FROM tb_konfirmasi WHERE id_lowongan='".$_POST["idLowongan"]."'";
            $query = mysql_query($sql);
            $result = mysql_fetch_array($query);
            $konfirmasi_ke = $result["ke"]+1;
            $sql = "INSERT INTO tb_konfirmasi(id_lowongan,konfirmasi_ke,pesan,ke) VALUES ('".$_POST["idLowongan"]."','".$konfirmasi_ke."','".$_POST["pesan"]."','".implode(",", $ke)."')";
            $query = mysql_query($sql);
            echo json_encode($data);
        }
        if($_GET["act"] == "fixed")
        {
            $sql = "UPDATE tb_lowongan SET fixed='1' WHERE id='".$_POST["idLowongan"]."'";
            $query = mysql_query($sql);
        }
    }
?>