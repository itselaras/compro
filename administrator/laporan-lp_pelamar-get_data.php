<?php 
    session_start();
    include("includes/connection.php");
    include("includes/function.php");
    $auth = authByID($_POST["auth"]);
    if($auth == 0)
    {
        $data["pelamar"] = array();
        $data["pendidikan"] = array();
        $date_from = $_POST["awal"];   
        $date_from = strtotime($date_from);
        $date_to = $_POST["akhir"];   
        $date_to = strtotime($date_to); 
        if($_POST["tipe"] == "hari")
        {
            for ($i=$date_from; $i<=$date_to; $i+=86400) {  
                $sql = "SELECT COUNT(id) AS banyak FROM tb_user WHERE DATE(created_at)='".date("Y-m-d", $i)."' AND type='2'";
                $query = mysql_query($sql);
                $result = mysql_fetch_array($query);
                // echo "Banyak ".date("Y-m-d", $i)." = ".$result["banyak"]."<br />";
                $hasil["tanggal"] = date("d M y", $i);
                $hasil["banyak"] = $result["banyak"];
                array_push($data["pelamar"], $hasil);
            }              
            if($_POST["awal"] == $_POST["akhir"])
            {
                $where = "DATE(c.created_at)>='".$_POST["awal"]."' OR DATE(c.created_at)<='".$_POST["akhir"]."'";                
            } else
            {
                $where = "DATE(c.created_at)>='".$_POST["awal"]."' AND DATE(c.created_at)<='".$_POST["akhir"]."'";                
            }
        }
        if($_POST["tipe"] == "bulan")
        {
            for ($i=$date_from; $i<=$date_to; $i+=2592000) {  
                $sql = "SELECT COUNT(id) AS banyak FROM tb_user WHERE MONTH(created_at)='".date("m", $i+172800)."' AND YEAR(created_at)='".date("Y",$i+172800)."' AND type='2'";
                $query = mysql_query($sql);
                $result = mysql_fetch_array($query);
                // echo "Banyak ".date("Y-m-d", $i+172800)." = ".$result["banyak"]."<br />";
                $hasil["tanggal"] = date("M y", $i+172800);
                $hasil["banyak"] = $result["banyak"];
                array_push($data["pelamar"], $hasil);
            }            
            $where = "MONTH(c.created_at)>=MONTH('".$_POST["awal"]."') AND YEAR(c.created_at)>=YEAR('".$_POST["awal"]."')) AND (MONTH(c.created_at)<=MONTH('".$_POST["akhir"]."') AND YEAR(c.created_at)<=YEAR('".$_POST["akhir"]."')"; 
        }
        if($_POST["tipe"] == "tahun")
        {
            $awal_tahun = date("Y",$date_from);
            $akhir_tahun = date("Y",$date_to);
            for ($i=$awal_tahun; $i <= $akhir_tahun; $i++) { 
                $sql = "SELECT COUNT(id) AS banyak FROM tb_user WHERE YEAR(created_at)='".$i."' AND type='2'";
                // echo $sql."<br>";
                $query = mysql_query($sql);
                $result = mysql_fetch_array($query);
                // echo "Banyak ".date("Y-m-d", $i)." = ".$result["banyak"]."<br />";
                $hasil["tanggal"] = $i;
                $hasil["banyak"] = $result["banyak"];
                array_push($data["pelamar"], $hasil);
            }
            // for ($i=$date_from; $i<=$date_to; $i+=31100000) {  
            // }              
            $where = "YEAR(c.created_at)>=YEAR('".$_POST["awal"]."') AND YEAR(c.created_at)<=YEAR('".$_POST["akhir"]."')";
        }
        $sql_pend = "SELECT CASE a.tingkatan WHEN '1' THEN 'SMA' WHEN '2' THEN 'Diploma' WHEN '3' THEN 'Sarjana' WHEN '4' THEN 'Pascasarjana' ELSE NULL END AS tingkatan,COUNT(a.id_pelamar) AS banyak
            FROM (SELECT c.created_at,a.id_pelamar,MAX(a.tingkatan) AS tingkatan 
            FROM tb_pend_formal a
            LEFT JOIN tb_pelamar b ON a.id_pelamar=b.id
            LEFT JOIN tb_user c ON b.id_user=c.id
            WHERE (".$where.")
            GROUP BY a.id_pelamar) AS a
            GROUP BY a.tingkatan
            ORDER BY a.tingkatan ASC";
        // echo $sql_pend;
        $query_pend = mysql_query($sql_pend);
        while($result_pend = mysql_fetch_array($query_pend)) 
        {
            // echo $result_pend["tingkatan"];
            $tingkatan["tingkatan"] = $result_pend["tingkatan"];
            $tingkatan["banyak"] = $result_pend["banyak"];
            array_push($data["pendidikan"], $tingkatan);
        }
        // print_r($data["pendidikan"]);
        echo json_encode($data);
    }
?>