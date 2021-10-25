<?php
    include("includes/connection.php");
    $sql = "SELECT * FROM tb_agenda WHERE id='".$_POST["id"]."'";
    $query = mysql_query($sql);
    $result = mysql_fetch_array($query);
?>
<!-- Modal -->
<div id="modal-agenda" data-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Detail Agenda</h4>
            </div>
            <div class="modal-body">
                <strong><?php echo $result["judul"] ?></strong><br><br>
                <div class="well">
                    <?php echo $result["deskripsi"] ?>
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
        $('#modal-agenda').modal('show');
    });
</script>