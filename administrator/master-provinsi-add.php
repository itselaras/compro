<?php 
    include("includes/header.php"); 
    cekLogin(array('1'));
    $negara = mysql_fetch_array(mysql_query("SELECT negara FROM tb_negara WHERE id='$_GET[id]'"));
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class="fa fa-bar-chart-o"></i> Provinsi / Negara Bagian</h1>
        </div>
    </div>
    <ol class="breadcrumb text-right">
        <li><a href="master-provinsi">Provinsi / Negara Bagian</a></li>
        <li class="active">Tambah Data</li>
    </ol>
    <div class="container-tambah">
        <input type="hidden" class="id-edit">
        <label>Provinsi / Negara Bagian (<?php echo $negara["negara"] ?>)</label>
        <div class="input-group">
            <input type="text" class="form-control input-provinsi">
            <span class="input-group-btn">
                <button class="btn btn-default btn-tambah" type="button"><i class="fa fa-plus-circle"></i></button>
            </span>
        </div>
    </div>
    <hr>
    <div class="container-data">
        <table id="provinsi-table" class="table table-bordered table-striped">
            <thead>
                <tr class="center">
                    <th>#</th>
                    <th class="text-center">Negara</th>
                    <th class="text-center">Provinsi / Negara Bagian <?php echo $negara["negara"] ?></th>
                    <th class="text-center">Option</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<?php include("includes/footer.php"); ?>

<script type="text/javascript">
    var data;
    $(document).ready(function() {
        $('.input-provinsi').focus();
        data = $('#provinsi-table').dataTable({
            "aoColumns": [
                { "bSearchable": false, "bSortable": true, "sClass": "text-center", "bVisible":false },        
                { "bSearchable": false, "bSortable": false, "bVisible":false },     
                { "bSearchable": true, "bSortable": true },        
                { "bSearchable": false, "sClass": "text-center", "bSortable": false },        
            ],
            "aaSorting": [[ 0, "desc" ]],
            "iDisplayLength": 10,
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "master-provinsi-tbl?source=provinsi&id=<?php echo $_GET['id'] ?>",
            "bPaginate": true,
            "bSort": true,
            "bAutoWidth": false,
            "fnServerData": function( sSource, aoData, fnCallback ){                           
                $.getJSON( sSource, aoData, function (json) {
                    fnCallback(json);
                });
            }
        });
        $('.btn-tambah').click(function(event) {
            that = $('.input-provinsi');
            if(that.val() != '')
            {
                if($('.id-edit').val() == '')
                {
                    act = 'tambah';
                    id = '<?php echo $_GET["id"] ?>';
                } else
                {
                    act = 'edit';
                    id = $('.id-edit').val();
                }
                $.ajax({
                    url: 'master-provinsi-act?act='+act,
                    type: 'POST',
                    data: {
                        id: id,
                        provinsi: that.val(),
                        auth: '<?php echo $_SESSION["loginID"] ?>'
                    },
                })
                .done(function() {
                    console.log("success");
                    that.val('');
                    $('.id-edit').val('');
                    that.focus();
                    data.fnStandingRedraw();
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    console.log("complete");
                });
                
            }
        });
        $('#provinsi-table').on('click', '.edit', function(event) {
            event.preventDefault();
            that = $(this);
            $('.input-provinsi').val(that.data('provinsi'));
            $('.id-edit').val(that.data('id'));
            $('.input-provinsi').focus();
        });
        $('#provinsi-table').on('click', '.delete', function(event) {
            event.preventDefault();
            that = $(this);
            bootbox.confirm("Yakin hapus data ini?", function(result) {
                if(result == true)
                {
                    $.ajax({
                        url: 'master-provinsi-act?act=hapus',
                        type: 'POST',
                        data: {
                            id: that.data('id'),
                            auth: '<?php echo $_SESSION["loginID"] ?>'
                        },
                    })
                    .done(function(result) {
                        console.log("success");
                        if(result == 0)
                        {
                            Example.show("Data berhasil dihapus.");  
                        } else
                        {
                            Error.show("Data digunakan pada tabel lain.");  
                        }  
                        data.fnStandingRedraw();
                        $('.input-provinsi').focus();
                    })
                    .fail(function() {
                        console.log("error");
                        Example.show("Data gagal dihapus.");  
                    })
                    .always(function() {
                        console.log("complete");
                    });
                } else
                {
                    Example.show("Penghapusan dibatalkan.");
                }
            });
        });
        $('.input-provinsi').keypress(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if(keycode == '13'){
                $('.btn-tambah').click();
            }
        });
    });
</script>