<?php
    include("includes/connection.php");
    $sql = "SELECT * FROM tbl_image WHERE id='".$_POST["id"]."'";
    $query = mysql_query($sql);
    $result = mysql_fetch_array($query);
?>
<!-- Modal -->
<div id="modal-galeri" data-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center" id="myModalLabel"><?php echo $result["nama"] ?></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <img src="../<?php echo $result['lokasi'] ?>" class="img-thumbnail">                    
                    </div>                    
                </div>
                <hr>
                <h4 class="modal-title text-center" id="myModalLabel">Deskripsi</h4>
                <div class="well">
                    <p align="justify"><?php echo $result["deskripsi"] ?></p>
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
        $('#modal-galeri').modal('show');
    });
</script>