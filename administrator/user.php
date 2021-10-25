<?php 
    include("includes/header.php"); 
    cekLogin(array('1'));  
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class="fa fa-user"></i> Manajemen Akun</h1>
        </div>
    </div>
    <a href="user-form?act=Tambah" class="btn btn-primary"><i class="fa fa-plus-square fa-fw"></i> Tambah Akun</a>
    <hr>
    <table id="my-table" class="table table-bordered table-striped">
        <thead>
            <tr class="center">
                <th>#</th>
                <th class="text-center">Nama Akun</th>
                <th class="text-center">Tipe Akun</th>
                <th class="text-center" width="15%">Option</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<?php include("includes/footer.php"); ?>

<!-- Modal -->
<div id="modal-password" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body password-content"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var data;
    $(document).ready(function() {
        data = $('#my-table').dataTable({
            "aoColumns": [
                { "bSearchable": false, "bSortable": true, "sClass": "text-center", "bVisible": false},        
                { "bSearchable": true, "bSortable": true },        
                { "bSearchable": false, "bSortable": true },        
                { "bSearchable": false, "bSortable": false, "sClass": "text-center" }        
            ],
            "aaSorting": [[ 2, "asc" ]],
            "iDisplayLength": 10,
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "user-tbl",
            "bPaginate": true,
            "bSort": true,
            "bAutoWidth": false,
            "fnServerData": function( sSource, aoData, fnCallback ){                           
                $.getJSON( sSource, aoData, function (json) {
                    fnCallback(json);
                });
            }
        });
        $('#my-table').on('click', '.reset', function(event) {
            event.preventDefault();
            that = $(this);
            bootbox.confirm("Reset password untuk username ini?", function(result) {
                if(result == true)
                {
                    $.ajax({
                        url: 'user-act?act=reset',
                        type: 'POST',
                        data: {
                            id: that.data('id'),
                            auth: '<?php echo $_SESSION["loginID"] ?>'
                        },
                    })
                    .done(function(data) {
                        console.log("success");
                        $('.password-content').html(data);
                        $('#modal-password').modal('show');
                    })
                    .fail(function() {
                        console.log("error");
                        Example.show("Reset password gagal.");  
                    })
                    .always(function() {
                        console.log("complete");
                    });
                } else
                {
                    Example.show("Reset password dibatalkan.");
                }
            });
        });
        $('#my-table').on('click', '.delete', function(event) {
            event.preventDefault();
            that = $(this);
            bootbox.confirm("Yakin hapus data ini?", function(result) {
                if(result == true)
                {
                    $.ajax({
                        url: 'user-act?act=hapus',
                        type: 'POST',
                        data: {
                            id: that.data('id'),
                            auth: '<?php echo $_SESSION["loginID"] ?>'
                        },
                    })
                    .done(function() {
                        console.log("success");
                        Example.show("Data berhasil dihapus.");  
                        data.fnStandingRedraw();
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
    });
</script>    