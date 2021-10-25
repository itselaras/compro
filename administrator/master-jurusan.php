<?php 
    include("includes/header.php"); 
    cekLogin(array('1'));
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class="fa fa-bar-chart-o"></i> Bidang Keahlian / Jurusan</h1>
        </div>
    </div>
    <a href="#" class="btn btn-primary tambah"><i class="fa fa-plus-square fa-fw"></i> Tambah Data</a>
    <hr>
    <table id="my-table" class="table table-bordered table-striped">
        <thead>
            <tr class="center">
                <th>#</th>
                <th class="text-center">Bidang Keahlian / Jurusan</th>
                <th class="text-center" width="30%">Option</th>
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
                { "bSearchable": false, "bSortable": true, "sClass": "text-center", "bVisible": false},        
                { "bSearchable": true, "bSortable": true },     
                { "bSearchable": false, "bSortable": false, "sClass": "text-center"}        
            ],
            "aaSorting": [[ 0, "desc" ]],
            "iDisplayLength": 10,
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "master-jurusan-tbl",
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
            bootbox.prompt("Bidang Keahlian / Jurusan", function(result) {                
                if (result === null) {                                             
                    Example.show("Penambahan dibatalkan.");                              
                } else {
                    if(result=='')
                    {
                        return false;
                    } else
                    {
                        $.ajax({
                            url: 'master-jurusan-act?act=tambah',
                            type: 'POST',
                            data: {
                                jurusan: result,
                                auth: '<?php echo $_SESSION["loginID"] ?>'
                            },
                        })
                        .done(function() {
                            console.log("success");
                            Example.show("Data berhasil ditambahkan.");  
                            data.fnStandingRedraw();
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
        });
        $('#my-table').on('click', '.edit', function(event) {
            event.preventDefault();
            that = $(this);
            bootbox.dialog({
                message: "<input type='hidden' class='old-id' value='"+that.data('id')+"'><input type='text' class='form-control old-data bootbox-input' value='"+that.data('jurusan')+"'>",
                title: "Bidang Keahlian / Jurusan",
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
                                    url: 'master-jurusan-act?act=edit',
                                    type: 'POST',
                                    data: {
                                        id: $('.old-id').val(),
                                        jurusan: $('.old-data').val(),
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
        });
        $('#my-table').on('click', '.delete', function(event) {
            event.preventDefault();
            that = $(this);
            bootbox.confirm("Yakin hapus data ini?", function(result) {
                if(result == true)
                {
                    $.ajax({
                        url: 'master-jurusan-act?act=hapus',
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

    