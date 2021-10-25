<?php
    include("includes/connection.php");
    include("includes/function.php");
?>
<!-- Modal -->
<div id="modal-pelamar" data-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="well">
                    <a href="../cv-pelamar?source=admin&id=<?php echo $_POST['id'] ?>" target="_blank" class="btn btn-primary btn-block btn-sm">Curriculum Vitae</a>
                    <?php
                        $sql = "SELECT * FROM tb_lampiran WHERE id_pelamar = '".$_POST["id"]."'";
                        $query = mysql_query($sql);
                        while($result = mysql_fetch_array($query))
                        {
                            $file = explode("/", $result["dir_file"]);
                            switch ($result["type"]) {
                                case '1':
                                    $tipe = "Foto";
                                    break;
                                case '2':
                                    $tipe = "Ijazah";
                                    break;
                                case '3':
                                    $tipe = "Transkrip";
                                    break;
                                case '4':
                                    $tipe = "Referensi";
                                    break;
                            }
                            echo "
                                <a href='../".$result["dir_file"]."' target='_blank' class='btn btn-primary btn-block btn-sm'>".$tipe."</a>
                            ";
                        }
                    ?>
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
        $('#modal-pelamar').modal('show');
    });
</script>