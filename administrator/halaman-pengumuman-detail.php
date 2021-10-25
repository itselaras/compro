<?php
    include("includes/connection.php");
    $sql = "SELECT * FROM tb_pengumuman WHERE id='".$_POST["id"]."'";
    $query = mysql_query($sql);
    $result = mysql_fetch_array($query);
    $tanggal = date("d M Y", strtotime($result["updated_at"]));
    $waktu = date("H:i", strtotime($result["updated_at"]));
?>
<!-- Modal -->
<div id="modal-pengumuman" data-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Pengumuman</h4>
            </div>
            <div class="modal-body">
                <ol class="breadcrumb">
                    <li><span class="fa fa-calendar"></span> <?php echo $tanggal; ?></li>
                    <li><span class="fa fa-clock-o"></span> <?php echo $waktu; ?></li>
                </ol>
                <ul id="myTab" class="nav nav-tabs">
                    <li class="active"><a href="#pengumuman" data-toggle="tab">Pengumuman</a></li>
                    <li><a href="#files" data-toggle="tab">Files</a></li>
                </ul><br>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade in active" id="pengumuman">
                        <?php echo $result["pengumuman"]; ?>
                    </div>
                    <div class="tab-pane fade" id="files">
                        <div class="well">
                            <?php
                                $sql_files = "SELECT * FROM tb_pengumuman_files WHERE id_pengumuman='$_POST[id]'";
                                $query_files = mysql_query($sql_files);
                                $i = 1;
                                while($result_files = mysql_fetch_array($query_files))
                                {
                                    $file = explode("/", $result_files["file"]);
                                    echo "
                                        <div class='file-detail'>
                                            <a href='../".$result_files["file"]."'><span onmouseover="."$(this).tooltip('show')"." data-toggle='tooltip' data-placement='top' data-original-title='Download' class='label label-default'><i class='fa fa-cloud-download'></i></span></a> 
                                            ".$result_files["nama_file"]." ($file[2])
                                        </div>
                                    ";
                                    $i++;
                                }
                                if($i == 1)
                                {
                                    echo "No file.";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#modal-pengumuman').modal('show');
    });
</script>