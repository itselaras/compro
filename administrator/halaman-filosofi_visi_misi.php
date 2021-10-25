<?php 
    include("includes/header.php"); 
    cekLogin(array('1'));
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class="fa fa-desktop"></i> Filosofi, Visi & Misi</h1>
        </div>
    </div>

    <ul id="myTab" class="nav nav-tabs">
        <li class="" data-tab="filosofi"><a href="#filosofi" data-toggle="tab">Filosofi</a></li>
        <li class="" data-tab="visi"><a href="#visi" data-toggle="tab">Visi</a></li>
        <li class="active" data-tab="misi"><a href="#misi" data-toggle="tab">Misi</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade" id="filosofi">
            <br>
            <div class="well container-konten"></div>
            <a href="#" class="btn btn-primary edit-data"><i class="fa fa-pencil"></i> Edit Data</a>
            <div class="container-edit invisible">
                <hr>
                <div class="form-group">
                    <label>Konten Halaman Utama</label>
                    <textarea class="form-control" id="halaman-filosofi" name="halaman-filosofi">$nbsp</textarea>
                </div>
                <a href="#" class="btn btn-primary btn-update"></i> OK</a>
                <a href="#" class="btn btn-default btn-cancel"></i> Cancel</a>        
            </div>
        </div>
        <div class="tab-pane fade" id="visi">
            <br>
            <div class="well container-konten"></div>
            <a href="#" class="btn btn-primary edit-data"><i class="fa fa-pencil"></i> Edit Data</a>
            <div class="container-edit invisible">
                <hr>
                <div class="form-group">
                    <label>Konten Halaman Utama</label>
                    <textarea class="form-control" id="halaman-visi" name="halaman-visi">$nbsp</textarea>
                </div>
                <a href="#" class="btn btn-primary btn-update"></i> OK</a>
                <a href="#" class="btn btn-default btn-cancel"></i> Cancel</a>        
            </div>
        </div>
        <div class="tab-pane fade active in" id="misi">
            <br>
            <div class="well container-konten"></div>
            <a href="#" class="btn btn-primary edit-data"><i class="fa fa-pencil"></i> Edit Data</a>
            <div class="container-edit invisible">
                <hr>
                <div class="form-group">
                    <label>Konten Halaman Utama</label>
                    <textarea class="form-control" id="halaman-misi" name="halaman-misi">$nbsp</textarea>
                </div>
                <a href="#" class="btn btn-primary btn-update"></i> OK</a>
                <a href="#" class="btn btn-default btn-cancel"></i> Cancel</a>        
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>

<script type="text/javascript">
    var tab = '';
    function loadData(tabActive){
        $.ajax({
            url: 'halaman-data',
            type: 'POST',
            dataType: 'json',
            data: {
                field: tabActive
            }
        })
        .done(function(data) {
            console.log("success");
            $('#'+tabActive+'').find('.container-konten').html(data.view);
            CKEDITOR.instances['halaman-'+tabActive+''].setData(data.ckeditor);
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
    }
    $(document).ready(function() {
        CKEDITOR.replace( 'halaman-filosofi', {
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
        CKEDITOR.replace( 'halaman-visi', {
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
        CKEDITOR.replace( 'halaman-misi', {
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
        $('#myTab a:first').tab('show')
        tab = $('#myTab').find('.active').data('tab');
        loadData(tab);
        $('#myTab li').click(function() {
            tab = $(this).data('tab');
            loadData(tab);
        });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            e.target;
            $('#'+tab+' .edit-data').click(function(event) {
                $('#'+tab+' .container-edit').removeClass('invisible').hide().slideDown('slow','easeInCirc');
            });
            $('#'+tab+' .btn-cancel').click(function(event) {
                $('#'+tab+' .container-edit').fadeOut('slow');
            });
            $('#'+tab+' .btn-update').click(function(event) {
                $.ajax({
                    url: 'halaman-act',
                    type: 'POST',
                    data: {
                        konten: CKEDITOR.instances['halaman-'+tab+''].getData(),
                        field: tab,
                        auth: '<?php echo $_SESSION["loginID"] ?>'
                    },
                })
                .done(function() {
                    console.log("success");
                    $('.btn-cancel').click();
                    loadData(tab);
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    console.log("complete");
                });
            });
        })
    });
</script>

    