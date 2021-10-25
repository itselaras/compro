<?php 
    session_start();
    ob_start();

    include("administrator/includes/connection.php");
    include("administrator/includes/function.php");
    include("includes/function.php");

    set_time_limit(0);
    if(isset($_GET["source"]) && $_GET["source"] == "admin")
    {
        $idPelamar = $_GET["id"];
        $where = "a.id = '".$idPelamar."'";
        $download = "<button id='download' class='admin-download'><i class='fa fa-download fa-3x'></i> DOWNLOAD</button>";
    } else
    {
        cekLogin(array('2'));
        $idPelamar = $_SESSION["pelamarID"];
        $where = "id_user = '".$_SESSION['loginID']."'";
        $download = "<button id='download' class='btn-download'><i class='fa fa-download fa-3x'></i> DOWNLOAD</button>";
    }
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>PT Selaras Mitra Integra - Curriculum Vitae</title>

        <!-- Bootstrap Core CSS -->
        <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->

        <!-- Custom CSS -->
        <link href="css/cv-pelamar.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="fonts/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,300' rel='stylesheet' type='text/css'>

    </head>

    <body class="page-top" class="index">
        <?php echo $download; ?>
        <div class="container">
            <div class="header">
                <div class="header-top">
                    <div id="logo">
                        <img src="img/smi-logo.png" class="img-logo" alt="Logo Kop Surat" data-filename="Logo SMI">
                    </div>
                    <div id="header-top-main">
                        RIWAYAT HIDUP<br>
                        <span class="english-field">CURRICULUM VITAE</span>
                    </div>
                </div>
            </div>
            <div class="body">
                <section id="identitas">

                    <?php
                        $sql_identitas = "SELECT a.*,DATE_FORMAT(a.tgl_lahir,'%d-%m-%Y') AS 'tgl_lahir', b.negara, c.bagian, d.kota FROM tb_pelamar a 
                        LEFT JOIN tb_negara b ON b.id = a.negara_id
                        LEFT JOIN tb_negara_bagian c on c.id = a.provinsi_id
                        LEFT JOIN tb_kota d ON d.id = a.kota_id
                        WHERE ".$where;
                        $query_identitas = mysql_query($sql_identitas);
                        $result_identitas = mysql_fetch_array($query_identitas);

                        $sql_foto = "SELECT * FROM tb_lampiran WHERE id_pelamar = ".$idPelamar." AND type = 1";
                        $query_foto = mysql_query($sql_foto);
                        $result_foto = mysql_fetch_array($query_foto)
                    ?>

                    <div class="section-header">
                        <div class="section-number">I.</div>
                        <div class-"section-heading">IDENTITAS / <span class="english-field">IDENTITY</span></div>
                    </div>
                    <div class="section-body section-foto">
                        <div id="foto">
                            <?php 
                                if ($result_foto['dir_file']!=''){
                                    ?>
                                    <img src="<?php echo $result_foto['dir_file'] ?>" class="img-foto" alt="Foto" data-filename="Foto Pelamar">
                                    <?php
                                };
                            ?>
                        </div>
                        <div class="section-row side-foto">
                            <label>
                                <div class="main-field">Nama Lengkap</div>
                                <span class="english-field">Full Name</span>
                            </label>
                            <div class="content">
                                <?php echo $result_identitas['nama_lengkap'] ?>
                            </div>
                        </div>
                        <div class="section-row side-foto">
                            <label>
                                <div class="main-field">Nama Panggilan</div>
                                <span class="english-field">Nick Name</span>
                            </label>
                            <div class="content">
                                <?php echo $result_identitas['nama_panggilan'] ?>
                            </div>
                        </div>
                        <div class="section-row">
                            <label>
                                <div class="main-field">Tempat & Tanggal Lahir</div>
                                <span class="english-field">Place & Date of Birth</span>
                            </label>
                            <div class="content">
                                <?php 
                                    if ($result_identitas['tempat_lahir']!='') {
                                        echo $result_identitas['tempat_lahir']." / ".$result_identitas['tgl_lahir'] ;
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="section-row side-foto">
                            <label>
                                <div class="main-field">Jenis Kelamin</div>
                                <span class="english-field">Sex</span>
                            </label>
                            <div class="content">
                                <?php 
                                    if ($result_identitas['jenis_kelamin']!='') {
                                        echo ($result_identitas['jenis_kelamin']==1) ? "LAKI-LAKI" : "PEREMPUAN"; 
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="section-row">
                            <label>
                                <div class="main-field">Alamat</div>
                                <span class="english-field">Address</span>
                            </label>
                            <div class="content">
                                <?php echo $result_identitas['alamat'] ?>
                            </div>
                        </div>
                        <div class="section-row sub-row">
                            <label>
                                <div class="main-field">Negara</div>
                                <span class="english-field">State</span>
                            </label>
                            <div class="content">
                                <?php echo $result_identitas['negara'] ?>
                            </div>
                        </div>
                        <div class="section-row sub-row">
                            <label>
                                <div class="main-field">Provinsi</div>
                                <span class="english-field">Province</span>
                            </label>
                            <div class="content">
                                <?php echo $result_identitas['bagian'] ?>
                            </div>
                        </div>
                        <div class="section-row sub-row">
                            <label>
                                <div class="main-field">Kota</div>
                                <span class="english-field">City</span>
                            </label>
                            <div class="content">
                                <?php echo $result_identitas['kota'] ?>
                            </div>
                        </div>
                        <div class="section-row">
                            <label>
                                <div class="main-field">Kode Pos</div>
                                <span class="english-field">Zip code</span>
                            </label>
                            <div class="content">
                                <?php echo $result_identitas['kode_pos'] ?>
                            </div>
                        </div>
                        <div class="section-row">
                            <label>
                                <div class="main-field">Telepon</div>
                                <span class="english-field">Phone</span>
                            </label>
                            <div class="content">
                                <?php echo $result_identitas['telepon'] ?>
                            </div>
                        </div>
                        <div class="section-row">
                            <label>
                                <div class="main-field">Handphone</div>
                                <span class="english-field">Handphone</span>
                            </label>
                            <div class="content">
                                <?php echo $result_identitas['hp'] ?>
                            </div>
                        </div>
                        <div class="section-row">
                            <label>
                                <div class="main-field">Email</div>
                                <span class="english-field">Email</span>
                            </label>
                            <div class="content email">
                                <?php echo $result_identitas['email'] ?>
                            </div>
                        </div>
                        <div class="section-row">
                            <label>
                                <div class="main-field">Agama</div>
                                <span class="english-field">Religion</span>
                            </label>
                            <div class="content">
                                <?php agamaSelected($result_identitas['agama']) ?>
                            </div>
                        </div>
                        <div class="section-row">
                            <label>
                                <div class="main-field">Nomor Identitas</div>
                                <span class="english-field">Identity Number</span>
                            </label>
                            <div class="content">
                                <?php echo $result_identitas['no_identitas'] ?>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="pendidikan">

                    <?php
                        $sql_formal = "SELECT a.*, b.jurusan FROM tb_pend_formal a
                        LEFT JOIN tb_jurusan b ON b.id = a.jurusan
                        WHERE id_pelamar = ".$idPelamar." ORDER BY a.tingkatan ASC";
                        $query_formal = mysql_query($sql_formal);
                        $count_formal = mysql_num_rows($query_formal);
                    ?>

                    <div class="section-header">
                        <div class="section-number">II.</div>
                        <div class-"section-heading">PENDIDIKAN / <span class="english-field">EDUCATION BACKGROUND</span></div>
                    </div>
                    <div class="section-body">
                        <div class="section-row wide-row">
                            <label>
                                <div class="main-field-number">1.</div>
                                <div class="main-field-content">
                                    <div class="main-field">Pendidikan Formal</div>
                                    <span class="english-field">Formal Education</span>
                                </div>
                            </label>
                            <div class="content sub-2">
                                <table>
                                    <thead>
                                        <tr>
                                            <th rowspan="2">No.</th>
                                            <th rowspan="2">Tingkatan</th>
                                            <th colspan="2" class="colspan">Tingkatan Tahun Sekolah</th>
                                            <th rowspan="2">Nama Sekolah / Universitas</th>
                                            <th rowspan="2">Tempat</th>
                                            <th rowspan="2">Fakultas</th>
                                            <th rowspan="2">Jurusan</th>
                                            <th rowspan="2">IPK</th>
                                            <th rowspan="2">Keterangan</th>
                                        </tr>
                                        <tr>
                                            <th class="colspan-row">Start</th>
                                            <th>Ending</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            if ($count_formal<1) {
                                                ?>
                                                <tr>
                                                    <td colspan="10">No data available in table</td>
                                                </tr>
                                                <?php
                                            }else{
                                                $i_formal = 1;
                                                while ($result_formal = mysql_fetch_array($query_formal)) {
                                                    if ($result_formal['tingkatan'] == 1 || $result_formal['tingkatan'] == 2 || $result_formal['tingkatan'] == 3 || $result_formal['tingkatan'] == 4) {
                                                        ?>
                                                        <tr>
                                                            <td class="text-center"><?php echo $i_formal ?></td>
                                                            <td><?php tingkatanSelected($result_formal['tingkatan']) ?></td>
                                                            <td class="text-center"><?php echo $result_formal['tahun_mulai'] ?></td>
                                                            <td class="text-center"><?php echo $result_formal['tahun_selesai'] ?></td>
                                                            <td><?php echo $result_formal['nama_instansi'] ?></td>
                                                            <td><?php echo $result_formal['tempat'] ?></td>
                                                            <td><?php echo $result_formal['fakultas'] ?></td>
                                                            <td><?php echo $result_formal['jurusan'] ?></td>
                                                            <td class="text-center"><?php echo $result_formal['ipk'] ?></td>
                                                            <td><?php echo $result_formal['keterangan'] ?></td>
                                                        </tr>
                                                        <?php
                                                    }else{
                                                        ?>
                                                        <tr>
                                                            <td class="text-center"><?php echo $i_formal ?></td>
                                                            <td><?php tingkatanSelected($result_formal['tingkatan']) ?></td>
                                                            <td class="text-center">-</td>
                                                            <td class="text-center">-</td>
                                                            <td>-</td>
                                                            <td>-</td>
                                                            <td>-</td>
                                                            <td>-</td>
                                                            <td>-</td>
                                                            <td class="text-center">-</td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    $i_formal++;
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="pendidikan">
                    <?php
                        $sql_informal = "SELECT *, DATE_FORMAT(periode_awal,'%d-%m-%Y') AS 'periode_awal', DATE_FORMAT(periode_akhir,'%d-%m-%Y') AS 'periode_akhir'  FROM tb_pend_informal
                        WHERE id_pelamar = ".$idPelamar." ORDER BY periode_awal ASC";
                        $query_informal = mysql_query($sql_informal);
                    ?>
                    <div class="section-body">
                        <div class="section-row wide-row">
                            <label>
                                <div class="main-field-number">2.</div>
                                <div class="main-field-content">
                                    <div class="main-field">Pendidikan Informal (Kursus/Pelatihan)</div>
                                    <span class="english-field">Informal Education (Course/Training)</span>
                                </div>
                            </label>
                            <div class="content sub-2">
                                <table>
                                    <thead>
                                        <tr>
                                            <th width="5%">No.</th>
                                            <th width="25%">Jenis Kursus/Pelatihan</th>
                                            <th width="20%">Tempat</th>
                                            <th width="25%" colspan="2">Periode</th>
                                            <th width="25%">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $i_informal = 1;
                                            while ($result_informal = mysql_fetch_array($query_informal)) {
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $i_informal ?></td>
                                                    <td><?php echo $result_informal['jenis_kursus'] ?></td>
                                                    <td class="text-center"><?php echo $result_informal['tempat'] ?></td>
                                                    <td class="text-center"><?php echo $result_informal['periode_awal'] ?></td>
                                                    <td class="text-center"><?php echo $result_informal['periode_akhir'] ?></td>
                                                    <td><?php echo $result_informal['keterangan'] ?></td>
                                                </tr>
                                                <?php
                                                $i_informal++;
                                            }

                                            if ($i_informal == 1) {
                                                ?>
                                                <tr>
                                                    <td colspan="6">No data available in table</td>
                                                </tr>
                                                <?php
                                            }
                                            $count_row = $i_informal;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="bahasa">
                    <?php
                        $sql_bahasa = "SELECT * FROM tb_bahasa_asing WHERE id_pelamar = ".$idPelamar."";
                        $query_bahasa = mysql_query($sql_bahasa);
                    ?>
                    <div class="section-body">
                        <div class="section-row wide-row">
                            <label>
                                <div class="main-field-number">3.</div>
                                <div class="main-field-content">
                                    <div class="main-field">Bahasa Asing</div>
                                    <span class="english-field">Foreign Language</span>
                                </div>
                            </label>
                            <div class="content sub-2">
                                <table>
                                    <thead>
                                        <tr>
                                            <th width="5%" rowspan="2">No.</th>
                                            <th width="25%" rowspan="2">Bahasa</th>
                                            <th width="20%" colspan="3">Lisan</th>
                                            <th width="20%" colspan="3">Tertulis</th>
                                        </tr>
                                        <tr>
                                            <th class="colspan-row">Kurang</th>
                                            <th>Cukup</th>
                                            <th>Baik</th>
                                            <th>Kurang</th>
                                            <th>Cukup</th>
                                            <th>Baik</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $i_bahasa = 1;
                                            while ($result_bahasa = mysql_fetch_array($query_bahasa)) {
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $i_bahasa ?></td>
                                                    <td><?php echo $result_bahasa['bahasa'] ?></td>
                                                    <?php 
                                                        for ($i_lisan=1; $i_lisan <= 3; $i_lisan++) { 
                                                            if ($result_bahasa['lisan'] == $i_lisan) {
                                                                echo "<td class='text-center'><i class='fa fa-check'></i></td>";
                                                            }else{
                                                                echo "<td class='text-center'></td>";
                                                            }
                                                        }

                                                        for ($i_tertulis=1; $i_tertulis <= 3; $i_tertulis++) { 
                                                            if ($result_bahasa['tertulis'] == $i_tertulis) {
                                                                echo "<td class='text-center'><i class='fa fa-check'></i></td>";
                                                            }else{
                                                                echo "<td class='text-center'></td>";
                                                            }
                                                        }
                                                    ?>
                                                </tr>
                                                <?php
                                                $i_bahasa++;
                                            }

                                            if ($i_bahasa == 1) {
                                                ?>
                                                <tr>
                                                    <td colspan="8">No data available in table</td>
                                                </tr>
                                                <?php
                                            }
                                            $count_row += $i_bahasa;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="keluarga">

                    <?php
                        $sql_keluarga = "SELECT * FROM tb_status_keluarga WHERE id_pelamar = ".$idPelamar."";
                        $query_keluarga = mysql_query($sql_keluarga);
                        $count_keluarga = mysql_num_rows($query_keluarga);
                    ?>

                    <div class="section-header">
                        <div class="section-number">III.</div>
                        <div class-"section-heading">STATUS KELUARGA / <span class="english-field">FAMILY STATUS</span></div>
                    </div>
                    <div class="section-body">
                        <div class="section-row">
                            <label>
                                <div class="main-field">Status Perkawinan</div>
                                <span class="english-field">Marital Status</span>
                            </label>
                            <div class="content">
                                <?php 
                                    if ($count_keluarga>0) {
                                        $result_keluarga = mysql_fetch_array($query_keluarga);
                                        keluargaSelected($result_keluarga['status']);
                                        if ($result_keluarga['status']!=1) {
                                            echo " sejak tahun ".$result_keluarga['sejak'];
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="pekerjaan">

                    <?php
                        $sql_pekerjaan = "SELECT a.*, b.bidang_bisnis, DATE_FORMAT(a.periode_awal,'%d-%m-%Y') AS periode_awal,DATE_FORMAT(a.periode_akhir,'%d-%m-%Y') AS periode_akhir FROM tb_riwayat_pekerjaan a 
                        LEFT JOIN tb_struktur_bidang_bisnis b on b.id = a.id_bidang_bisnis 
                        WHERE a.id_pelamar = '".$idPelamar."' ORDER BY a.periode_awal ASC";
                        $query_pekerjaan = mysql_query($sql_pekerjaan);
                    ?>

                    <div class="section-header">
                        <div class="section-number">IV.</div>
                        <div class-"section-heading">RIWAYAT PEKERJAAN / <span class="english-field">OCCUPATIONAL BACKGROUND</span></div>
                    </div>
                    <div class="section-body">
                        <div class="section-row wide-row">
                            <label>
                                <div class="main-field-number">1.</div>
                                <div class="main-field-content">
                                    <div class="main-field">Pengalaman Kerja</div>
                                    <span class="english-field">Work Experience</span>
                                </div>
                            </label>
                            <div class="content sub-2">
                                <table>
                                    <thead>
                                        <tr>
                                            <th width="8%">No.</th>
                                            <th width="18%">Perusahaan</th>
                                            <th width="18%">Bisnis Perusahaan</th>
                                            <th width="20%" colspan="2">Periode</th>
                                            <th width="15%">Posisi</th>
                                            <th width="15%">Jumlah Bawahan</th>
                                            <th width="20%">Gaji Terakhir</th>
                                            <th width="25%">Alasan Pindah</th>
                                            <th width="25%">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $i_pekerjaan = 1;
                                            while ($result_pekerjaan = mysql_fetch_array($query_pekerjaan)) {
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $i_pekerjaan ?></td>
                                                    <td><?php echo $result_pekerjaan['perusahaan'] ?></td>
                                                    <td><?php echo $result_pekerjaan['bidang_bisnis'] ?></td>
                                                    <td class="text-center"><?php echo $result_pekerjaan['periode_awal'] ?></td>
                                                    <td class="text-center"><?php echo $result_pekerjaan['periode_akhir'] ?></td>
                                                    <td><?php echo $result_pekerjaan['posisi'] ?></td>
                                                    <td class="text-center"><?php echo $result_pekerjaan['jumlah_bawahan'] ?></td>
                                                    <td>
                                                        <span class="pull-left">Rp</span>
                                                        <span class="pull-right"><?php echo number_format($result_pekerjaan['gaji_terakhir'],2, ',', '.'); ?></span>
                                                    </td>
                                                    <td><?php echo $result_pekerjaan['alasan_pindah'] ?></td>
                                                    <td><?php echo $result_pekerjaan['deskripsi_pekerjaan'] ?></td>
                                                </tr>
                                                <?php
                                                $i_pekerjaan++;
                                                $count_row ++;
                                            }

                                            if ($i_pekerjaan == 1) {
                                                ?>
                                                <tr>
                                                    <td colspan="10">No data available in table</td>
                                                </tr>
                                                <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="minat">

                    <?php
                        $sql_minat = "SELECT a.*, b.bagian AS provinsi_minat, c.kota AS kota_minat, d.negara AS negara_minat, e.bidang_bisnis, f.fungsi_kerja, g.level_jabatan, h.posisi_kerja FROM tb_minat a 
                        LEFT JOIN tb_negara_bagian b ON b.id = a.lokasi_provinsi
                        LEFT JOIN tb_kota c ON c.id = a.lokasi_kota
                        LEFT JOIN tb_negara d ON d.id = a.lokasi_negara
                        LEFT JOIN tb_struktur_bidang_bisnis e ON e.id = a.bidang_bisnis
                        LEFT JOIN tb_struktur_fungsi_kerja f ON f.id = a.fungsi_kerja
                        LEFT JOIN tb_struktur_level_jabatan g ON g.id = a.level_jabatan
                        LEFT JOIN tb_struktur_posisi_kerja h ON h.id = a.posisi_kerja
                        WHERE a.id_pelamar = '".$idPelamar."'";
                        $query_minat = mysql_query($sql_minat);
                    ?>

                    <div class="section-header">
                        <div class="section-number">V.</div>
                        <div class-"section-heading">MINAT DAN HARAPAN / <span class="english-field">INTEREST AND EXPECTATION</span></div>
                    </div>

                    <div class="section-body">
                        <div class="section-row wide-row">
                            <div class="content sub-2">
                                <table>
                                    <thead>
                                        <tr>
                                            <th width="5%" rowspan="2">No.</th>
                                            <th width="20%" colspan="3">Preferensi Lokasi</th>
                                            <th width="15%" rowspan="2">Gaji Bulanan</th>
                                            <th width="15%" rowspan="2">Bidang Bisnis</th>
                                            <th width="15%" rowspan="2">Spesialisasi</th>
                                            <th width="15%" rowspan="2">Posisi Kerja</th>
                                            <th width="15%" rowspan="2">Level Jabatan</th>
                                        </tr>
                                        <tr>
                                            <th class="colspan-row">Negara</th>
                                            <th>Provinsi</th>
                                            <th>Kota</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $i_minat = 1;
                                            while ($result_minat = mysql_fetch_array($query_minat)) {
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $i_minat ?></td>
                                                    <td class="text-center"><?php echo $result_minat['negara_minat'] ?></td>
                                                    <td class="text-center"><?php echo $result_minat['provinsi_minat'] ?></td>
                                                    <td class="text-center"><?php echo $result_minat['kota_minat'] ?></td>
                                                    <td>
                                                        <span class="pull-left">Rp</span>
                                                        <span class="pull-right"><?php echo number_format($result_minat['gaji_nominal'],2, ',', '.'); ?></span>
                                                    </td>
                                                    <td class="text-center"><?php echo $result_minat['bidang_bisnis'] ?></td>
                                                    <td class="text-center"><?php echo $result_minat['fungsi_kerja'] ?></td>
                                                    <td class="text-center"><?php echo $result_minat['posisi_kerja'] ?></td>
                                                    <td class="text-center"><?php echo $result_minat['level_jabatan'] ?></td>
                                                </tr>
                                                <?php
                                                $i_minat++;
                                                $count_row ++;
                                            }

                                            if ($i_minat == 1) {
                                                ?>
                                                <tr>
                                                    <td colspan="10">No data available in table</td>
                                                </tr>
                                                <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="sosial">

                    <?php
                        $sql_sport = "SELECT * FROM tb_soc_act WHERE id_pelamar = ".$idPelamar." AND type = 1";
                        $query_sport = mysql_query($sql_sport);
                        $result_sport = mysql_fetch_array($query_sport);
                    ?>

                    <?php
                        $sql_hobi = "SELECT * FROM tb_soc_act WHERE id_pelamar = ".$idPelamar." AND type = 2";
                        $query_hobi = mysql_query($sql_hobi);
                        $result_hobi = mysql_fetch_array($query_hobi);
                    ?>

                    <div class="section-header">
                        <div class="section-number">VI.</div>
                        <div class-"section-heading">AKTIVITAS SOSIAL / <span class="english-field">SOCIAL ACTIVITIES</span></div>
                    </div>
                    <div class="section-body">
                        <div class="section-row">
                            <label>
                                <div class="main-field-number">1.</div>
                                <div class="main-field-content">
                                    <div class="main-field">Olahraga</div>
                                    <span class="english-field">Sports</span>
                                </div>
                            </label>
                            <div class="content long-content">
                                <?php echo $result_sport['keterangan'] ?>
                            </div>
                        </div>
                        <div class="section-row">
                            <label>
                                <div class="main-field-content sub-field">
                                    <div class="main-field">Hobi</div>
                                    <span class="english-field">Hobbies</span>
                                </div>
                            </label>
                            <div class="content long-content">
                                <?php echo $result_hobi['keterangan'] ?>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="organisasi">
                    <?php
                        $sql_organisasi = "SELECT *,DATE_FORMAT(periode_awal,'%d-%m-%Y') AS periode_awal,DATE_FORMAT(periode_akhir,'%d-%m-%Y') AS periode_akhir FROM tb_organisasi WHERE id_pelamar = ".$idPelamar;
                        $query_organisasi = mysql_query($sql_organisasi);
                    ?>
                    <div class="section-body">
                        <div class="section-row wide-row">
                            <label>
                                <div class="main-field-number">2.</div>
                                <div class="main-field-content">
                                    <div class="main-field">Organisasi</div>
                                    <span class="english-field">Organization</span>
                                </div>
                            </label>
                            <div class="content sub-2">
                                <table>
                                    <thead>
                                        <tr>
                                            <th width="5%">No.</th>
                                            <th width="25%">Organisasi</th>
                                            <th width="25%" colspan="2">Periode</th>
                                            <th width="20%">Tempat</th>
                                            <th width="20%">Posisi</th>
                                            <th width="25%">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $i_organisasi = 1;
                                            while ($result_organisasi = mysql_fetch_array($query_organisasi)) {
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $i_organisasi ?></td>
                                                    <td><?php echo $result_organisasi['organisasi'] ?></td>
                                                    <td class="text-center"><?php echo $result_organisasi['periode_awal'] ?></td>
                                                    <td class="text-center"><?php echo $result_organisasi['periode_akhir'] ?></td>
                                                    <td class="text-center"><?php echo $result_organisasi['tempat'] ?></td>
                                                    <td class="text-center"><?php echo $result_organisasi['posisi'] ?></td>
                                                    <td><?php echo $result_organisasi['keterangan'] ?></td>
                                                </tr>
                                                <?php
                                                $i_organisasi++;
                                            }

                                            if ($i_organisasi == 1) {
                                                ?>
                                                <tr>
                                                    <td colspan="7">No data available in table</td>
                                                </tr>
                                                <?php
                                            }
                                            $count_row = $i_organisasi;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="sakit">

                    <?php
                        $sql_sakit = "SELECT *,DATE_FORMAT(periode_awal,'%d-%m-%Y') AS periode_awal,DATE_FORMAT(periode_akhir,'%d-%m-%Y') AS periode_akhir FROM tb_riwayat_penyakit WHERE id_pelamar = ".$idPelamar;
                        $query_sakit = mysql_query($sql_sakit);
                    ?>

                    <div class="section-header">
                        <div class="section-number">VII.</div>
                        <div class-"section-heading">LAIN-LAIN</div>
                    </div>
                    <div class="section-body">
                        <div class="section-row wide-row">
                            <label>
                                <div class="main-field-number">1.</div>
                                <div class="main-field-content">
                                    <div class="main-field">Pernahkah Anda dirawat di rumah sakit dalam 2 tahun terakhir?</div>
                                    <span class="english-field">Have you ever been hospitalized in the last 2 years?</span>
                                </div>
                            </label>
                            <div class="content sub-2">
                                <table>
                                    <thead>
                                        <tr>
                                            <th width="5%">No.</th>
                                            <th width="25%">Jenis Penyakit</th>
                                            <th width="25%" colspan="2">Periode</th>
                                            <th width="25%">Pengaruh</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $i_sakit = 1;
                                            while ($result_sakit = mysql_fetch_array($query_sakit)) {
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $i_sakit ?></td>
                                                    <td><?php echo $result_sakit['jenis_penyakit'] ?></td>
                                                    <td class="text-center"><?php echo $result_sakit['periode_awal'] ?></td>
                                                    <td class="text-center"><?php echo $result_sakit['periode_akhir'] ?></td>
                                                    <td><?php echo $result_sakit['pengaruh'] ?></td>
                                                </tr>
                                                <?php
                                                $i_sakit++;
                                            }

                                            if ($i_sakit == 1) {
                                                ?>
                                                <tr>
                                                    <td colspan="5">No data available in table</td>
                                                </tr>
                                                <?php
                                            }
                                            $count_row = $i_sakit;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="informasi">

                    <?php
                        $sql_informasi = "SELECT * FROM tb_informasi WHERE id_pelamar = ".$idPelamar."";
                        $query_informasi = mysql_query($sql_informasi);
                        $result_informasi = mysql_fetch_array($query_informasi);
                    ?>

                    <div class="section-body">
                        <div class="section-row">
                            <label>
                                <div class="main-field-number">2.</div>
                                <div class="main-field-content">
                                    <div class="main-field">Tahu informasi PT Selaras Mitra Integra dari: </div>
                                </div>
                            </label>
                            <div class="content">
                                <?php informasiSelected($result_informasi['sumber_informasi']) ?>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>


        <!-- jQuery Version 1.11.0 -->
        <script src="js/jquery-1.11.0.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.js"></script>

        <script type="text/javascript">

            $(document).ready(function() {
                $('.btn-download').click(function() {
                    window.location.href='cv-pelamar-pdf';
                });
                $('.admin-download').click(function(event) {
                    window.location.href='cv-pelamar-pdf?source=admin&id=<?php echo $idPelamar ?>';
                });
            });
        </script>
    
    </body>

</html>