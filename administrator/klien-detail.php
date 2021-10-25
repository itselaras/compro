<?php
    include("includes/connection.php");
    $sql = "SELECT * FROM tb_klien WHERE id='".$_POST["id"]."'";
    $query = mysql_query($sql);
    $result = mysql_fetch_array($query);
?>
<!-- Modal -->
<div id="modal-klien" data-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center"><strong class="text-center"><?php echo $result["perusahaan"] ?></strong></div>
                <hr>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <img src="../<?php echo $result['logo'] ?>" class="img-thumbnail">                    
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
        $('#modal-klien').modal('show');
    });
</script>