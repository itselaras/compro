<?php
    include("includes/connection.php");
?>
<div id="modal-konfirmasi" class="modal fade in" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="display: block;">
    <div class="modal-dialog" style="width: 60%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Pesan Konfirmasi</h4>
            </div>
            <div class="modal-body">
                <?php
                    $isi_select = "";
                    $isi = "";
                    $kolom1 = "";
                    $kolom2 = "";
                    $sql = "SELECT * FROM tb_konfirmasi WHERE id_lowongan='".$_POST["id"]."'";
                    $query = mysql_query($sql);
                    while($result = mysql_fetch_array($query))
                    {
                        $isi_select .= "<option value='".$result["konfirmasi_ke"]."'>".$result["konfirmasi_ke"]."</option>";
                        $array_ke = explode(",",$result["ke"]);
                        // print_r($array_ke);
                        $baris = floor((sizeof($array_ke))/2);
                        // echo $baris;
                        for ($i=0; $i <= $baris ; $i++) { 
                            $kolom1 .= "<li>".$array_ke[$i]."</li>";
                        }
                        for ($i=($baris+1); $i <= (sizeof($array_ke)-1) ; $i++) { 
                            $kolom2 .= "<li>".$array_ke[$i]."</li>";
                        }
                        $isi .= "
                            <div class='well-konfirmasi ".$result["konfirmasi_ke"]." invisible'>
                                <label>Pesan Konfirmasi</label>
                                <div class='well'>
                                    ".$result["pesan"]."
                                </div>
                                <label>Penerima Pesan</label>
                                <div class='well'>
                                    <ol>
                                    <div class='row'>
                                        <div class='col-md-6'>".$kolom1."</div>
                                        <div class='col-md-6'>".$kolom2."</div>
                                    </div>
                                    </ol>
                                </div>                                
                            </div>
                        ";
                        $kolom1 = "";
                        $kolom2 = "";
                    }
                ?>
                <div class="form-group">
                    <label>Konfirmasi ke</label>
                    <select class="pilih-konfirmasi form-control">
                        <option value="">- - Pilih Konfirmasi - -</option>
                        <?php echo $isi_select ?>
                    </select>                    
                </div>
                <?php echo $isi ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#modal-konfirmasi').modal('show');
        $('.pilih-konfirmasi').change(function(event) {
            that = $(this);
            if(that.val() == '')
            {
                $('.well-konfirmasi').slideUp('slow');
            } else
            {
                $('.well-konfirmasi').hide();
                $('.'+that.val()).slideDown('slow');
            }
        });
    });
</script>