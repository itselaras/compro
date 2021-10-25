<?php 
    include("includes/header.php"); 
    cekLogin(array('1'));
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class="fa fa-building"></i> Perusahaan Klien</h1>
        </div>
    </div>
    <a href="klien-form?act=Tambah" class="btn btn-primary"><i class="fa fa-plus-square fa-fw"></i> Tambah Data</a>
    <hr>
    <table id="my-table" class="table table-bordered table-striped">
        <thead>
            <tr class="center">
                <th>#</th>
                <th class="text-center">Perusahaan</th>
                <th class="text-center" width="15%">Option</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<?php include("includes/footer.php"); ?>

<script type="text/javascript">
    var data;
    $(document).ready(function() {
        data = $('#my-table').dataTable({
            "aoColumns": [
                { "bSearchable": false, "bSortable": false, "sClass": "text-center", "bVisible": false},        
                { "bSearchable": true, "bSortable": true },      
                { "bSearchable": false, "bSortable": false, "sClass": "text-center"}        
            ],
            "aaSorting": [[ 1, "asc" ]],
            "iDisplayLength": 10,
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "klien-tbl?act=klien",
            "bPaginate": true,
            "bSort": true,
            "bAutoWidth": false,
            "fnServerData": function( sSource, aoData, fnCallback ){                           
                $.getJSON( sSource, aoData, function (json) {
                    fnCallback(json);
                });
            }
        });
        $('#my-table').on('click', '.delete', function(event) {
            event.preventDefault();
            that = $(this);
            bootbox.confirm("Yakin hapus data ini?", function(result) {
                if(result == true)
                {
                    $.ajax({
                        url: 'klien-act?act=hapus',
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
        $('#my-table').on('click', '.detail', function(event) {
            event.preventDefault();
            that = $(this);
            $.ajax({
                url: 'klien-detail',
                type: 'POST',
                data: {id: that.data('id')},
            })
            .done(function(data) {
                $('#modal-container').html(data);
                console.log("success");
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