<?php 
    include("includes/header.php"); 
    cekLogin(array('1'));  
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class="fa fa-envelope"></i> Pesan</h1>
        </div>
    </div>
    <table class="table table-bordered" id="my-table">
        <thead>
            <th>#</th>
            <th>From</th>
            <th>Email</th>
            <th>Tanggal</th>
            <th>Respon</th>
            <th>Balasan</th>
            <th>Status</th>
            <th>Option</th>
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
                { "bSearchable": false, "bSortable": true, "sClass": "text-center", "bVisible": false},        
                { "bSearchable": true, "bSortable": true },      
                { "bSearchable": true, "bSortable": true },      
                { "bSearchable": true, "bSortable": true },      
                { "bSearchable": false, "bSortable": true, "sClass": "text-center"},    
                { "bSearchable": false, "bSortable": false, "bVisible": false},    
                { "bSearchable": true, "bSortable": true, "bVisible": false },      
                { "bSearchable": false, "bSortable": false, "sClass": "text-center"}        
            ],
            "aaSorting": [[ 0, "desc" ]],
            "iDisplayLength": 10,
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "pesan-tbl",
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
                    if($(oSettings.aoData[oSettings.aiDisplay[i]].nTr).find('.status-pesan').data('status') == "0")
                    {
                        $(oSettings.aoData[oSettings.aiDisplay[i]].nTr).css('background-color', '#d9edf7');
                    }
                }
            }
        });
        $('#my-table').on('click', '.pesan-balas', function(event) {
            that = $(this);
            that.find('i').removeAttr('class').addClass('fa fa-spinner fa-spin fa-border');
            $('#my-table .pesan-balas').removeClass('pesan-balas');
            event.preventDefault();
            $.ajax({
                url: 'pesan-act?act=update',
                type: 'POST',
                data: {
                    id: that.data('id'),
                    auth: '<?php echo $_SESSION["loginID"] ?>'
                },
            })
            .done(function() {
                console.log("success");
                window.location.href='pesan-baca?id='+that.data('id');
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
        });
        $('#my-table').on('click', '.balasan', function(event) {
            bootbox.alert($(this).data('balasan'));
        });
        $('#my-table').on('click', '.delete', function(event) {
            event.preventDefault();
            that = $(this);
            that.find('i').removeAttr('class').addClass('fa fa-spinner fa-spin fa-border');
            bootbox.confirm("Yakin hapus data ini?", function(result) {
                if(result == true)
                {
                    $.ajax({
                        url: 'pesan-act?act=hapus',
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
                        that.find('i').removeAttr('class').addClass('fa fa-trash-o fa-border');
                    });
                } else
                {
                    Example.show("Penghapusan dibatalkan.");
                    that.find('i').removeAttr('class').addClass('fa fa-trash-o fa-border');
                }
            });
        });
    });
</script>