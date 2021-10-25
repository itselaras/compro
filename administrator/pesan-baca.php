<?php 
    include("includes/header.php"); 
    cekLogin(array('1'));  
    if(isset($_GET["act"]) && $_GET["act"] == "shortcut")
    {
        $query = mysql_query("UPDATE tb_pesan SET status_baca='1' WHERE id='".$_GET["id"]."'");        
    }
    $sql = "SELECT a.*,b.nama_lengkap FROM tb_pesan a LEFT JOIN tb_pelamar b ON a.from=b.id WHERE a.id='".$_GET["id"]."'";
    $query = mysql_query($sql);
    $result = mysql_fetch_array($query);
?>

<style type="text/css">
    .tbl-pesan > tbody > tr > td {
        padding: 5px 10px;
    }
</style>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class="fa fa-envelope"></i> Pesan</h1>
        </div>
    </div>
    <ol class="breadcrumb text-right">
        <li><a href="pesan">Pesan</a></li>
        <li class="active">Baca Pesan</li>
    </ol>
    <div class="tbl-container">
        <table class="tbl-pesan">
            <tbody>
                <tr>
                    <td>From</td>
                    <td>:</td>
                    <td><?php echo $result["nama_lengkap"]==""?"ANONYMOUS":$result["nama_lengkap"] ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><?php echo $result["email"] ?></td>
                </tr>
                <tr>
                    <td colspan="3"><i class="fa fa-calendar"></i> <?php echo date_format(date_create($result["tanggal"]),"d M Y"); ?></td>
                </tr>
            </tbody>
        </table>        
    </div>
    <hr>
    <div class="col-md-12 text-center" style="margin-top: -37px;">
        <button type="button" class="btn btn-sm btn-default btn-round btn-toggle" data-class="select-container" data-toggle="tooltip" data-placement="top" data-original-title="Show/Hide" onmouseover="$(this).tooltip('show')"><i class="fa fa-chevron-up"></i></button>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label>Balas</label>
            <textarea id="pesan-balas"></textarea><br>
            <button type="button" class="btn btn-primary btn-kirim"><i class="fa fa-send"></i> Kirim</button>
        </div>
        <div class="col-md-6">
            <label>Pesan</label>
            <div class="well">
                <?php echo $result["pesan"] ?>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>

<script type="text/javascript">
    $(document).ready(function() {
        CKEDITOR.replace( 'pesan-balas', {
            toolbar : [
                { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
                { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
                { name: 'paragraph', groups: [ 'list', 'indent', 'align' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
                { name: 'links', items: [ 'Link', 'Unlink' ] },
                { name: 'insert', items: [ 'Table', 'SpecialChar' ] },
                { name: 'styles', items: [ 'FontSize' ] },
                { name: 'colors', items: [ 'TextColor' ] }
            ]
        });
        $('.btn-toggle').click(function(event) {
            $('.tbl-container').slideToggle('slow');
            $('.btn-toggle').find('i').toggleClass('fa-chevron-down');
            $('.btn-toggle').find('i').toggleClass('fa-chevron-up');
        });
        $('.btn-kirim').click(function(event) {
            if(CKEDITOR.instances['pesan-balas'].getData() != '')
            {
                $('#modal-loading').find('.loading-container').html('Mengirim pesan...');
                $('#modal-loading').modal('show');
                $.ajax({
                    url: 'pesan-act?act=balas',
                    type: 'POST',
                    data: {
                        id: '<?php echo $_GET["id"] ?>',
                        pesan: CKEDITOR.instances['pesan-balas'].getData(),
                        auth: '<?php echo $_SESSION["loginID"] ?>',
                    },
                })
                .done(function() {
                    $.ajax({
                        url: 'kirim-email',
                        type: 'POST',
                        data: {
                            email: '<?php echo $result["email"] ?>',
                            pesan: CKEDITOR.instances['pesan-balas'].getData()
                        },
                    })
                    .done(function() {
                        console.log("success");
                        $('#modal-loading').find('.loading-container').html('Pesan terkirim');
                        setTimeout(function(){
                            $('#modal-loading').modal('hide');     
                            window.location.href='pesan';            
                        },1000);
                    })
                    .fail(function() {
                        console.log("error");
                    })
                    .always(function() {
                        console.log("complete");
                    });
                    console.log("success");
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    console.log("complete");
                });                
            } else
            {
                Error.show('Mohon mengisi pesan balasan.');
            }
        });
    });
</script>