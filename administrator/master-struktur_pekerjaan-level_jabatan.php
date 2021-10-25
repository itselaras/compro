<?php 
    include("includes/header.php"); 
    cekLogin(array('1'));
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
        </div>
            <h1 class="page-header"><i class="fa fa-bar-chart-o"></i> Struktur Pekerjaan - Level Jabatan</h1>
    </div>
    <ol class="breadcrumb">
        <li><a href="master-struktur_pekerjaan-bidang_bisnis">Bidang Bisnis</a></li>
        <li><a href="master-struktur_pekerjaan-function">Spesialisasi</a></li>
        <li><a href="master-struktur_pekerjaan-posisi">Posisi</a></li>
        <li class="active">Level Jabatan</li>
    </ol>
    <a href="#" class="btn btn-primary tambah"><i class="fa fa-plus-square fa-fw"></i> Tambah Data</a>
    <hr>
    <table id="my-table" class="table table-bordered table-striped">
        <thead>
            <tr class="center">
                <th>#</th>
                <th class="text-center">Level Jabatan</th>
                <th class="text-center" width="30%">Option</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<?php include("includes/footer.php"); ?>

<script type="text/javascript">
    var source = [];
    var data;
    function bootBox(bootModal){
        bootModal.on('shown.bs.modal', function(event) {
            event.preventDefault();
            if(source == '')
            {
                $.ajax({
                    url: 'master-struktur_pekerjaan-source?tb=level_jabatan',
                    dataType: 'json'
                })
                .done(function(data) {
                    console.log("success");
                    $.each(data, function(index, val) {
                         source.push(val);
                    });
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    console.log("complete");
                });
            }
            $('.bootbox-input').typeahead({
                source: source
            });                    
        });
    }
    $(document).ready(function() {
        data = $('#my-table').dataTable({
            "aoColumns": [
                { "bSearchable": false, "bSortable": true, "sClass": "text-center", "bVisible": false},        
                { "bSearchable": true, "bSortable": true },     
                { "bSearchable": false, "bSortable": false, "sClass": "text-center"}        
            ],
            "aaSorting": [[ 0, "desc" ]],
            "iDisplayLength": 10,
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "master-struktur_pekerjaan-tbl?source=level_jabatan",
            "bPaginate": true,
            "bSort": true,
            "bAutoWidth": false,
            "fnServerData": function( sSource, aoData, fnCallback ){                           
                $.getJSON( sSource, aoData, function (json) {
                    fnCallback(json);
                });
            }
        });
        $('.tambah').click(function(event) {
            bootModal = bootbox.prompt("Level Jabatan", function(result) {                
                if (result === null) {                                             
                    Example.show("Penambahan dibatalkan.");                              
                } else {
                    if(result=='')
                    {
                        return false;
                    } else
                    {
                        $.ajax({
                            url: 'master-struktur_pekerjaan-act?act=tambah&tb=level_jabatan',
                            type: 'POST',
                            data: {
                                dataValue: result,
                                auth: '<?php echo $_SESSION["loginID"] ?>'
                            },
                        })
                        .done(function() {
                            console.log("success");
                            Example.show("Data berhasil ditambahkan.");  
                            data.fnStandingRedraw();
                            source = [];
                        })
                        .fail(function() {
                            console.log("error");
                            Example.show("Penambahan gagal.");                              
                        })
                        .always(function() {
                            console.log("complete");
                        });
                    }
                }
            });
            bootBox(bootModal);
        });
        $('#my-table').on('click', '.edit', function(event) {
            event.preventDefault();
            that = $(this);
            bootModal = bootbox.dialog({
                message: "<input type='hidden' class='old-id' value='"+that.data('id')+"'><input type='text' class='form-control old-data bootbox-input' value='"+that.data('text')+"'>",
                title: "Level Jabatan",
                buttons: {
                    success: {
                        label: "Cancel",
                        className: "btn-success",
                        callback: function() {
                            Example.show("Edit data dibatalkan.");
                        }
                    },
                    main: {
                        label: "OK",
                        className: "btn-primary",
                        callback: function() {
                            if($('.old-data').val()=='')
                            {
                                return false;
                            } else
                            {
                                $.ajax({
                                    url: 'master-struktur_pekerjaan-act?act=edit&tb=level_jabatan',
                                    type: 'POST',
                                    data: {
                                        id: $('.old-id').val(),
                                        dataValue: $('.old-data').val(),
                                        auth: '<?php echo $_SESSION["loginID"] ?>'
                                    },
                                })
                                .done(function() {
                                    console.log("success");
                                    Example.show("Data berhasil diubah.");  
                                    data.fnStandingRedraw();
                                    source = [];
                                })
                                .fail(function() {
                                    console.log("error");
                                    Example.show("Edit data gagal.");                              
                                })
                                .always(function() {
                                    console.log("complete");
                                });
                            }
                        }
                    }
                }
            });
            bootBox(bootModal);
        });
        $('#my-table').on('click', '.delete', function(event) {
            event.preventDefault();
            that = $(this);
            bootbox.confirm("Yakin hapus data ini?", function(result) {
                if(result == true)
                {
                    $.ajax({
                        url: 'master-struktur_pekerjaan-act?act=hapus&tb=level_jabatan',
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
                        source = [];
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