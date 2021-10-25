<?php 
    session_start();
    include("includes/connection.php");
    include("includes/function.php");
    $auth = authByID($_POST["auth"]);
    if($auth == 0)
    {
        $data = array();
        $dataHasil = array();
        $dataOption = array();
        if(!isset($_POST["lowonganPilih"]) || $_POST["lowonganPilih"] == "")
        {
            if(isset($_GET["get"]))
            {
                if($_POST["tipe"] == "hari")
                {
                    $where = "a.tanggal='".$_POST["tanggal"]."'";
                }
                if($_POST["tipe"] == "bulan")
                {
                    $where = "MONTH(a.tanggal)=MONTH('".$_POST["tanggal"]."') AND YEAR(a.tanggal)=YEAR('".$_POST["tanggal"]."')";
                }
                if($_POST["tipe"] == "tahun")
                {
                    $where = "YEAR(a.tanggal)=YEAR('".$_POST["tanggal"]."')";
                }
                if($_GET["get"] == "select")
                {
                    $sql = "SELECT a.tanggal,d.perusahaan,e.bidang_bisnis,f.fungsi_kerja,g.posisi_kerja,h.level_jabatan,IFNULL(c.pelamar,'0') AS pelamar,IFNULL(c.diterima,'0') AS diterima
                        FROM tb_lowongan a
                        LEFT JOIN tb_klien b ON a.id_klien=b.id
                        LEFT JOIN (SELECT a.id_lowongan,IFNULL(b.pelamar,'0') AS pelamar,IFNULL(c.diterima,'0') AS diterima
                        FROM tb_rekrutmen a 
                        LEFT JOIN (SELECT id_lowongan,COUNT(id_pelamar) AS pelamar FROM tb_rekrutmen GROUP BY id_lowongan) b ON a.id_lowongan=b.id_lowongan
                        LEFT JOIN (SELECT id_lowongan,COUNT(id_pelamar) AS diterima FROM tb_rekrutmen WHERE STATUS='1' GROUP BY id_lowongan) c ON a.id_lowongan=c.id_lowongan
                        GROUP BY a.id_lowongan) c ON a.id=c.id_lowongan
                        LEFT JOIN tb_klien d ON a.id_klien=d.id
                        LEFT JOIN tb_struktur_bidang_bisnis e ON a.id_bidang_perusahaan=e.id
                        LEFT JOIN tb_struktur_fungsi_kerja f ON a.id_function=f.id
                        LEFT JOIN tb_struktur_posisi_kerja g ON a.id_posisi=g.id
                        LEFT JOIN tb_struktur_level_jabatan h ON a.id_jabatan=h.id WHERE ".$where." ORDER BY d.perusahaan ASC";
                    // echo $sql;
                    $query = mysql_query($sql);
                    while($result = mysql_fetch_array($query))
                    {
                        $option["lowongan"] = date_format(date_create($result["tanggal"]),"d M Y")."<br>".$result["perusahaan"]."<br>".$result["bidang_bisnis"]."<br>".$result["fungsi_kerja"]." | ".$result["posisi_kerja"]." | ".$result["level_jabatan"];
                        $option["pelamar"] = $result["pelamar"];
                        $option["diterima"] = $result["diterima"];
                        array_push($dataOption, $option);
                    }
                    $sql = "SELECT b.perusahaan,COUNT(id_klien) AS banyak
                        FROM tb_lowongan a
                        LEFT JOIN tb_klien b ON a.id_klien=b.id
                        WHERE ".$where."
                        GROUP BY a.id_klien ORDER BY b.perusahaan ASC";
                    // echo $sql;
                    $query = mysql_query($sql);
                    while($result = mysql_fetch_array($query))
                    {
                        $hasil["perusahaan"] = $result["perusahaan"];
                        $hasil["value"] = $result["banyak"];
                        array_push($dataHasil, $hasil);
                    }
                    $data["hasil"] = $dataHasil;
                    $data["option"] = $dataOption;                 
                }
            } else
            {
                $date_from = $_POST["awal"];   
                $date_from = strtotime($date_from);
                $date_to = $_POST["akhir"];   
                $date_to = strtotime($date_to); 
                if($_POST["tipe"] == "hari")
                {
                    for ($i=$date_from; $i<=$date_to; $i+=86400) {  
                        $sql = "SELECT COUNT(id) AS banyak FROM tb_lowongan WHERE DATE(tanggal)='".date("Y-m-d", $i)."'";
                        $query = mysql_query($sql);
                        $result = mysql_fetch_array($query);
                        // echo "Banyak ".date("Y-m-d", $i)." = ".$result["banyak"]."<br />";
                        $hasil["nama"] = date("d M y", $i);
                        $hasil["banyak"] = $result["banyak"];
                        array_push($dataHasil, $hasil);
                        $option["tanggal"] = date("Y-m-d",$i);
                        $option["tampil"] = date("d M Y",$i);
                        array_push($dataOption, $option);
                    }              
                }
                if($_POST["tipe"] == "bulan")
                {
                    for ($i=$date_from; $i<=$date_to; $i+=2592000) {  
                        $sql = "SELECT COUNT(id) AS banyak FROM tb_lowongan WHERE MONTH(tanggal)='".date("m", $i)."' AND YEAR(tanggal)='".date("Y",$i)."'";
                        $query = mysql_query($sql);
                        $result = mysql_fetch_array($query);
                        // echo "Banyak ".date("Y-m-d", $i)." = ".$result["banyak"]."<br />";
                        $hasil["nama"] = date("M y", $i);
                        $hasil["banyak"] = $result["banyak"];
                        array_push($dataHasil, $hasil);
                        $option["tanggal"] = date("Y-m-d",$i);
                        $option["tampil"] = date("M Y",$i);
                        array_push($dataOption, $option);
                    }              
                }
                if($_POST["tipe"] == "tahun")
                {
                    for ($i=$date_from; $i<=$date_to; $i+=31104000) {  
                        $sql = "SELECT COUNT(id) AS banyak FROM tb_lowongan WHERE YEAR(tanggal)='".date("Y",$i)."'";
                        $query = mysql_query($sql);
                        $result = mysql_fetch_array($query);
                        // echo "Banyak ".date("Y-m-d", $i)." = ".$result["banyak"]."<br />";
                        $hasil["nama"] = date("Y", $i);
                        $hasil["banyak"] = $result["banyak"];
                        array_push($dataHasil, $hasil);
                        $option["tanggal"] = date("Y-m-d",$i);
                        $option["tampil"] = date("Y",$i);
                        array_push($dataOption, $option);
                    }              
                }
                $data["hasil"] = $dataHasil;
                $data["option"] = $dataOption; 
            }
        } else
        {
            $sql = "SELECT a.tanggal,d.perusahaan,e.bidang_bisnis,f.fungsi_kerja,g.posisi_kerja,h.level_jabatan,IFNULL(c.pelamar,'0') AS pelamar,IFNULL(c.diterima,'0') AS diterima
                FROM tb_lowongan a
                LEFT JOIN tb_klien b ON a.id_klien=b.id
                LEFT JOIN (SELECT a.id_lowongan,IFNULL(b.pelamar,'0') AS pelamar,IFNULL(c.diterima,'0') AS diterima
                FROM tb_rekrutmen a 
                LEFT JOIN (SELECT id_lowongan,COUNT(id_pelamar) AS pelamar FROM tb_rekrutmen GROUP BY id_lowongan) b ON a.id_lowongan=b.id_lowongan
                LEFT JOIN (SELECT id_lowongan,COUNT(id_pelamar) AS diterima FROM tb_rekrutmen WHERE STATUS='1' GROUP BY id_lowongan) c ON a.id_lowongan=c.id_lowongan
                GROUP BY a.id_lowongan) c ON a.id=c.id_lowongan
                LEFT JOIN tb_klien d ON a.id_klien=d.id
                LEFT JOIN tb_struktur_bidang_bisnis e ON a.id_bidang_perusahaan=e.id
                LEFT JOIN tb_struktur_fungsi_kerja f ON a.id_function=f.id
                LEFT JOIN tb_struktur_posisi_kerja g ON a.id_posisi=g.id
                LEFT JOIN tb_struktur_level_jabatan h ON a.id_jabatan=h.id WHERE a.id='".$_POST["lowonganPilih"]."' ORDER BY d.perusahaan ASC";
            // echo $sql;
            $query = mysql_query($sql);
            while($result = mysql_fetch_array($query))
            {
                $option["lowongan"] = date_format(date_create($result["tanggal"]),"d M Y")."<br>".$result["perusahaan"]."<br>".$result["bidang_bisnis"]."<br>".$result["fungsi_kerja"]." | ".$result["posisi_kerja"]." | ".$result["level_jabatan"];
                $option["pelamar"] = $result["pelamar"];
                $option["diterima"] = $result["diterima"];
                array_push($dataOption, $option);
            }
            $data["hasil"] = $dataOption;
            $data["param"] = "lowongan";
        }
        echo json_encode($data);            
    }
?>