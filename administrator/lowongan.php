<?php 
    include("includes/header.php"); 
    cekLogin(array('1'));
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class="fa fa-briefcase"></i> Lowongan Pekerjaan</h1>
        </div>
    </div>
    <a href="lowongan-form?act=Tambah" class="btn btn-primary"><i class="fa fa-plus-square fa-fw"></i> Tambah Data</a>
    <hr>
    <table id="my-table" class="table table-bordered">
        <thead>
            <tr class="center">
                <th>#</th>
                <th class="text-center">Perusahaan</th>
                <th class="text-center">Bidang</th>
                <th class="text-center">Spesialisasi</th>
                <th class="text-center">Posisi</th>
                <th class="text-center">Jabatan</th>
                <th class="text-center">Status</th>
                <th class="text-center">Status</th>
                <th class="text-center" style="min-width: 100px;">Option</th>
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
                { "bSearchable": false, "bSortable": true, "sClass": "text-center", "bVisible": false },        
                { "bSearchable": true, "bSortable": true },     
                { "bSearchable": true, "bSortable": true },     
                { "bSearchable": true, "bSortable": true },     
                { "bSearchable": true, "bSortable": true },     
                { "bSearchable": true, "bSortable": true },     
                { "bSearchable": true, "bSortable": true, "bVisible": false },     
                { "bSearchable": false, "bSortable": false, "sClass": "text-center" },     
                { "bSearchable": false, "bSortable": false, "sClass": "text-center"}        
            ],
            "aaSorting": [[ 0, "desc" ]],
            "iDisplayLength": 10,
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "lowongan-tbl",
            "bPaginate": true,
            "bSort": true,
            "bAutoWidth": false,
            "fnServerData": function( sSource, aoData, fnCallback ){                           
                $.getJSON( sSource, aoData, function (json) {
                    fnCallback(json);
                });
            },
            "fnDrawCallback": function(oSettings){
                for(var i =0, iLen = oSettings.aiDisplay.length; i<iLen; i++){
                    if($(oSettings.aoData[oSettings.aiDisplay[i]].nTr).find('.aktif').data('aktif') == "tidak")
                    {
                        $(oSettings.aoData[oSettings.aiDisplay[i]].nTr).css('background-color', '#cecece');
                    }
                }
            }
        });
        $('#my-table').on('click', '.delete', function(event) {
            event.preventDefault();
            that = $(this);
            bootbox.confirm("Yakin hapus data ini?", function(result) {
                if(result == true)
                {
                    $.ajax({
                        url: 'lowongan-act?act=hapus',
                        type: 'POST',
                        data: {
                            id: that.data('id'),
                            auth: '<?php echo $_SESSION["loginID"] ?>'
                        },
                    })
                    .done(function(data) {
                        console.log("success");
                        if(data == 0)
                        {
                            Example.show("Data berhasil dihapus.");  
                            data.fnStandingRedraw();
                        } else
                        {
                            Error.show('Data digunakan pada tabel lain.');
                        }
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
                url: 'lowongan-detail',
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