<?php
    include("includes/connection.php");
?>
<!-- Modal -->
<div id="modal-riwayat" data-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Riwayat Lamaran Pekerjaan</h4>
            </div>
            <div class="modal-body">
                <table id="tabel-riwayat" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Perusahaan</th>
                            <th>Bidang Bisnis</th>
                            <th>Spesialisasi</th>
                            <th>Posisi</th>
                            <th>Level Jabatan</th>
                            <th>Status</th>
                        </tr>
                    </thead>    
                    <tbody>
                        <?php
                            if(isset($_POST["idKlien"]) && isset($_POST["idLowongan"]))
                            {
                                $where = " AND d.id='".$_POST["idKlien"]."' AND c.id<>'".$_POST["idLowongan"]."'";
                            } else
                            {
                                $where = "";
                            }
                            $sql = "SELECT DATE_FORMAT(a.tanggal,'%d-%m-%Y') AS tanggal,d.perusahaan,e.bidang_bisnis,f.fungsi_kerja,g.posisi_kerja,h.level_jabatan,IF(a.status=1,'Diterima','Tidak Diterima') AS status
                                FROM tb_rekrutmen a
                                LEFT JOIN tb_pelamar b ON a.id_pelamar=b.id
                                LEFT JOIN tb_lowongan c ON a.id_lowongan=c.id
                                LEFT JOIN tb_klien d ON c.id_klien=d.id
                                LEFT JOIN tb_struktur_bidang_bisnis e ON c.id_bidang_perusahaan=e.id
                                LEFT JOIN tb_struktur_fungsi_kerja f ON c.id_function=f.id
                                LEFT JOIN tb_struktur_posisi_kerja g ON c.id_posisi=g.id
                                LEFT JOIN tb_struktur_level_jabatan h ON c.id_jabatan=h.id
                                WHERE b.id='".$_POST["id"]."'".$where;
                            $query = mysql_query($sql);
                            while($result = mysql_fetch_array($query))
                            {
                                echo "<tr>
                                    <td>".$result["tanggal"]."</td>
                                    <td>".$result["perusahaan"]."</td>
                                    <td>".$result["bidang_bisnis"]."</td>
                                    <td>".$result["fungsi_kerja"]."</td>
                                    <td>".$result["posisi_kerja"]."</td>
                                    <td>".$result["level_jabatan"]."</td>
                                    <td>".$result["status"]."</td>
                                </tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#tabel-riwayat').dataTable({
            "aoColumns": [       
                { "bSearchable": false, "bSortable": true },     
                { "bSearchable": true, "bSortable": true },     
                { "bSearchable": true, "bSortable": true },     
                { "bSearchable": true, "bSortable": true },     
                { "bSearchable": true, "bSortable": true },     
                { "bSearchable": true, "bSortable": true },     
                { "bSearchable": true, "bSortable": true, "sClass": "text-center"}        
            ],
            "aaSorting": [[ 0, "desc" ]]
        });
        $('#modal-riwayat').modal('show');
    });
</script>