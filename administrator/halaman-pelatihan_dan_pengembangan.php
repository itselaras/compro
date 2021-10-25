<?php 
    include("includes/header.php"); 
    cekLogin(array('1'));
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class="fa fa-desktop"></i> Pelatihan dan Pengembangan</h1>
        </div>
    </div>
    <div class="well container-konten"></div>
    <a href="#" class="btn btn-primary edit-data"><i class="fa fa-pencil"></i> Edit Data</a>
    <div class="container-edit invisible">
        <hr>
        <div class="form-group">
            <label>Pelatihan dan Pengembangan</label>
            <textarea class="form-control" id="halaman-pelatihan" name="halaman-pelatihan"></textarea>
        </div>
        <a href="#" class="btn btn-primary btn-update"></i> OK</a>
        <a href="#" class="btn btn-default btn-cancel"></i> Cancel</a>        
    </div>
</div>

<?php include("includes/footer.php"); ?>

<script type="text/javascript">
    function loadData(){
        $.ajax({
            url: 'halaman-data',
            type: 'POST',
            dataType: 'json',
            data: {
                field: 'pelatihan_dan_pengembangan'
            }
        })
        .done(function(data) {
            console.log("success");
            $('.container-konten').html(data.view);
            CKEDITOR.instances['halaman-pelatihan'].setData(data.ckeditor);
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
    }
    $(document).ready(function() {
        loadData();
        CKEDITOR.replace( 'halaman-pelatihan', {
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
        $('.edit-data').click(function(event) {
            $('.container-edit').removeClass('invisible').hide().slideDown('slow','easeInCirc');
        });
        $('.btn-cancel').click(function(event) {
            $('.container-edit').fadeOut('slow');
        });
        $('.btn-update').click(function(event) {
            $.ajax({
                url: 'halaman-act',
                type: 'POST',
                data: {
                    konten: CKEDITOR.instances['halaman-pelatihan'].getData(),
                    field: 'pelatihan_dan_pengembangan',
                    auth: '<?php echo $_SESSION["loginID"] ?>'
                },
            })
            .done(function() {
                console.log("success");
                $('.btn-cancel').click();
                loadData();
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
        });
    });
</script>

    