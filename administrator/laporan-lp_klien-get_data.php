<?php 
    session_start();
    include("includes/connection.php");
    include("includes/function.php");
    $auth = authByID($_POST["auth"]);
    if($auth == 0)
    {
        $data = array();
        $date_from = $_POST["awal"];   
        $date_from = strtotime($date_from);
        $date_to = $_POST["akhir"];   
        $date_to = strtotime($date_to); 
        if($_POST["tipe"] == "hari")
        {
            if($_POST["perusahaan"] == "")
            {
                $sql = "SELECT b.perusahaan,COUNT(a.id) AS banyak
                    FROM tb_lowongan a
                    LEFT JOIN tb_klien b ON a.id_klien=b.id
                    WHERE DATE(tanggal)='".$_POST["awal"]."'
                    GROUP BY a.id_klien
                    ORDER BY b.perusahaan ASC";
                $query = mysql_query($sql);
                while($result = mysql_fetch_array($query))
                {
                    $hasil["nama"] = $result["perusahaan"];
                    $hasil["banyak"] = $result["banyak"];
                    array_push($data, $hasil);
                }
            } else
            {
                for ($i=$date_from; $i<=$date_to; $i+=86400) {  
                    $sql = "SELECT b.perusahaan,COUNT(a.id) AS banyak FROM tb_lowongan a LEFT JOIN tb_klien b ON a.id_klien=b.id WHERE DATE(a.tanggal)='".date("Y-m-d", $i)."' AND a.id_klien='".$_POST["perusahaan"]."'";
                    $query = mysql_query($sql);
                    $result = mysql_fetch_array($query);
                    // echo "Banyak ".date("Y-m-d", $i)." = ".$result["banyak"]."<br />";
                    $hasil["nama"] = date("d M y", $i);
                    $hasil["banyak"] = $result["banyak"];
                    array_push($data, $hasil);
                }                              
            }
        }
        if($_POST["tipe"] == "bulan")
        {
            if($_POST["perusahaan"] == "")
            {
                $sql = "SELECT b.perusahaan,COUNT(a.id) AS banyak
                    FROM tb_lowongan a
                    LEFT JOIN tb_klien b ON a.id_klien=b.id
                    WHERE MONTH(tanggal)=MONTH('".$_POST["awal"]."')
                    GROUP BY a.id_klien
                    ORDER BY b.perusahaan ASC";
                $query = mysql_query($sql);
                while($result = mysql_fetch_array($query))
                {
                    $hasil["nama"] = $result["perusahaan"];
                    $hasil["banyak"] = $result["banyak"];
                    array_push($data, $hasil);
                }
            } else
            {
                for ($i=$date_from; $i<=$date_to; $i+=2592000) {  
                    $sql = "SELECT b.perusahaan,COUNT(a.id) AS banyak FROM tb_lowongan a LEFT JOIN tb_klien b ON a.id_klien=b.id WHERE MONTH(a.tanggal)='".date("m", $i)."' AND YEAR(a.tanggal)='".date("Y", $i)."' AND a.id_klien='".$_POST["perusahaan"]."'";
                    $query = mysql_query($sql);
                    $result = mysql_fetch_array($query);
                    // echo "Banyak ".date("Y-m-d", $i)." = ".$result["banyak"]."<br />";
                    $hasil["nama"] = date("M y", $i);
                    $hasil["banyak"] = $result["banyak"];
                    array_push($data, $hasil);
                }      
            }        
        }
        if($_POST["tipe"] == "tahun")
        {
            if($_POST["perusahaan"] == "")
            {
                $sql = "SELECT b.perusahaan,COUNT(a.id) AS banyak
                    FROM tb_lowongan a
                    LEFT JOIN tb_klien b ON a.id_klien=b.id
                    WHERE YEAR(tanggal)=YEAR('".$_POST["awal"]."')
                    GROUP BY a.id_klien
                    ORDER BY b.perusahaan ASC";
                $query = mysql_query($sql);
                while($result = mysql_fetch_array($query))
                {
                    $hasil["nama"] = $result["perusahaan"];
                    $hasil["banyak"] = $result["banyak"];
                    array_push($data, $hasil);
                }
            } else
            {
                for ($i=$date_from; $i<=$date_to; $i+=31104000) {  
                    $sql = "SELECT b.perusahaan,COUNT(a.id) AS banyak FROM tb_lowongan a LEFT JOIN tb_klien b ON a.id_klien=b.id WHERE YEAR(a.tanggal)='".date("Y", $i)."' AND a.id_klien='".$_POST["perusahaan"]."'";
                    $query = mysql_query($sql);
                    $result = mysql_fetch_array($query);
                    // echo "Banyak ".date("Y-m-d", $i)." = ".$result["banyak"]."<br />";
                    $hasil["nama"] = date("Y", $i);
                    $hasil["banyak"] = $result["banyak"];
                    array_push($data, $hasil);
                }              
            }
        }
        if(sizeof($data) == 0)
        {
            $hasil["nama"] = date_format(date_create($_POST["awal"]),"d M y");
            $hasil["banyak"] = 0;
            array_push($data, $hasil);
        }
        echo json_encode($data);
    }
?>