<?php 
    include("includes/header.php"); 
    cekLogin(array('1'));
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class="fa fa-tags"></i> Manajemen Pelamar</h1>
        </div>
    </div>
    <table id="my-table" class="table table-bordered">
        <thead>
            <tr class="center">
                <th>#</th>
                <th class="text-center">Perusahaan</th>
                <th class="text-center">Bidang</th>
                <th class="text-center">Spesialisasi</th>
                <th class="text-center">Posisi</th>
                <th class="text-center">Jabatan</th>
                <th class="text-center">Rekrut</th>
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
                { "bSearchable": false, "bSortable": false, "sClass": "text-center" },     
                { "bSearchable": true, "bSortable": true, "bVisible": false },     
                { "bSearchable": false, "bSortable": false, "sClass": "text-center" },     
                { "bSearchable": false, "bSortable": false, "sClass": "text-center"}        
            ],
            "aaSorting": [[ 0, "desc" ]],
            "iDisplayLength": 10,
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "lowongan-tbl?source=rekrutmen",
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
                    if($(oSettings.aoData[oSettings.aiDisplay[i]].nTr).find('.detail').data('aktif') == 0)
                    {
                        $(oSettings.aoData[oSettings.aiDisplay[i]].nTr).css('background-color', '#cecece');
                    }
                    $(oSettings.aoData[oSettings.aiDisplay[i]].nTr).find('.fa-times').closest('tr').find('.pesan-konfirmasi').addClass('no-pesan-konfirmasi').removeClass('pesan-konfirmasi');
                }
            }
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
        $('#my-table').on('click', '.no-pesan-konfirmasi', function(event) {
            event.preventDefault();
            bootbox.alert('Lowongan ini belum dikonfirmasi.');
        });
        $('#my-table').on('click', '.pesan-konfirmasi', function(event) {
            event.preventDefault();
            that = $(this);
            that.find('i').removeAttr('class').addClass('fa fa-spinner fa-spin fa-border');
            $.ajax({
                url: 'rekrutmen-konfirmasi',
                type: 'POST',
                data: {
                    id: that.data('id')
                },
            })
            .done(function(data) {
                console.log("success");
                that.find('i').removeAttr('class').addClass('fa fa-comment-o fa-border');
                $('#modal-container').html(data);
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