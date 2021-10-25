<?php
    include("includes/connection.php");
    include("includes/function.php");
    $sql = "SELECT c.perusahaan,b.bidang_bisnis,d.fungsi_kerja,e.posisi_kerja,f.level_jabatan,a.awal_berlaku,a.akhir_berlaku,a.deskripsi_pekerjaan,a.syarat_jenis_kelamin,a.syarat_pendidikan,a.syarat_ipk,a.syarat_pengalaman,h.jurusan,a.syarat_usia FROM tb_lowongan a LEFT JOIN tb_struktur_bidang_bisnis b ON a.id_bidang_perusahaan=b.id LEFT JOIN tb_klien c ON a.id_klien=c.id LEFT JOIN tb_struktur_fungsi_kerja d ON a.id_function=d.id LEFT JOIN tb_struktur_posisi_kerja e ON a.id_posisi=e.id LEFT JOIN tb_struktur_level_jabatan f ON a.id_jabatan=f.id LEFT JOIN tb_jurusan h ON a.syarat_jurusan=h.id WHERE a.id='".$_POST["id"]."'";
    $query = mysql_query($sql);
    $result = mysql_fetch_array($query);
    if($result["syarat_jenis_kelamin"] == 1)
    {
        $jenis_kelamin = "Laki-laki";
    }
    if($result["syarat_jenis_kelamin"] == 2)
    {
        $jenis_kelamin = "Perempuan";        
    }
?>
<!-- Modal -->
<div id="modal-agenda" data-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="page-header topless">
                    <h3 class="topless">
                        <?php echo $result["perusahaan"] ?><br>
                        <small><?php echo $result["bidang_bisnis"] ?></small><br>
                        <small style="font-size: 10pt;"><?php echo $result["fungsi_kerja"]." | ".$result["posisi_kerja"]." | ".$result["level_jabatan"] ?></small><br>
                        <small style="font-size: 10pt;"><i class="fa fa-calendar"></i> <?php echo date_format(date_create($result["awal_berlaku"]),"d M Y"); ?> - <?php echo date_format(date_create($result["akhir_berlaku"]),"d M Y"); ?></small>
                    </h3>
                </div>
                <?php echo $result["deskripsi_pekerjaan"] ?>
                <?php
                    if(($result["syarat_jenis_kelamin"] != "") || ($result["syarat_pendidikan"] != "") || ($result["syarat_ipk"] != "") || ($result["syarat_pengalaman"] != "") || !is_null(($result["jurusan"])) ||($result["syarat_usia"] != ""))
                    {   
                        echo "<small>";
                            echo "Filters:";
                            echo "<ul>";
                                if($result["syarat_jenis_kelamin"] != ""){ echo "<li>Jenis kelamin : ".$jenis_kelamin."</li>"; }
                                if($result["syarat_pendidikan"] != ""){ echo "<li>Pendidikan terakhir : ".cekPendidikan($result["syarat_pendidikan"])."</li>"; }
                                if($result["jurusan"] != ""){ echo "<li>Jurusan : ".$result["jurusan"]."</li>"; }
                                if($result["syarat_ipk"] != ""){ echo "<li>IPK : ".$result["syarat_ipk"]."</li>"; }
                                if($result["syarat_pengalaman"] != ""){ echo "<li>Pengalaman kerja : ".$result["syarat_pengalaman"]." tahun</li>"; }
                                if($result["syarat_usia"] != ""){ echo "<li>Umur/usia : ".$result["syarat_usia"]." tahun</li>"; }
                            echo "</ul>";
                        echo "</small>";
                    }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#modal-agenda').modal('show');
    });
</script>