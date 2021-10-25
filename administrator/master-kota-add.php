<?php 
    include("includes/header.php"); 
    cekLogin(array('1'));
    $bagian = mysql_fetch_array(mysql_query("SELECT bagian FROM tb_negara_bagian WHERE id='$_GET[id]'"));
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class="fa fa-bar-chart-o"></i> Kota</h1>
        </div>
    </div>
    <ol class="breadcrumb text-right">
        <li><a href="master-kota">Kota</a></li>
        <li class="active">Tambah Data</li>
    </ol>
    <div class="container-tambah">
        <input type="hidden" class="id-edit">
        <label>Kota (<?php echo $bagian["bagian"] ?>)</label>
        <div class="input-group">
            <input type="text" class="form-control input-kota">
            <span class="input-group-btn">
                <button class="btn btn-default btn-tambah" type="button"><i class="fa fa-plus-circle"></i></button>
            </span>
        </div>
    </div>
    <hr>
    <div class="container-data">
        <table id="kota-table" class="table table-bordered table-striped">
            <thead>
                <tr class="center">
                    <th>#</th>
                    <th class="text-center">Provinsi / Negara Bagian</th>
                    <th class="text-center">Kota <?php echo $bagian["bagian"] ?></th>
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
        $('.input-kota').focus();
        data = $('#kota-table').dataTable({
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
            "sAjaxSource": "master-kota-tbl?source=kota&id=<?php echo $_GET['id'] ?>",
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
            that = $('.input-kota');
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
                    url: 'master-kota-act?act='+act,
                    type: 'POST',
                    data: {
                        id: id,
                        kota: that.val(),
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
        $('#kota-table').on('click', '.edit', function(event) {
            event.preventDefault();
            that = $(this);
            $('.input-kota').val(that.data('kota'));
            $('.id-edit').val(that.data('id'));
            $('.input-kota').focus();
        });
        $('#kota-table').on('click', '.delete', function(event) {
            event.preventDefault();
            that = $(this);
            bootbox.confirm("Yakin hapus data ini?", function(result) {
                if(result == true)
                {
                    $.ajax({
                        url: 'master-kota-act?act=hapus',
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
                        $('.input-kota').focus();
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
        $('.input-kota').keypress(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if(keycode == '13'){
                $('.btn-tambah').click();
            }
        });
    });
</script>