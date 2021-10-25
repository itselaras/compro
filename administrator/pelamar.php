<?php 
    include("includes/header.php"); 
    cekLogin(array('1'));
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class="fa fa-briefcase"></i> Manajemen Source</h1>
        </div>
    </div>
    <div class="col-md-12 text-center" style="margin-top: -37px;">
        <button type="button" class="btn btn-sm btn-default btn-round btn-toggle" data-class="select-container" data-toggle="tooltip" data-placement="top" data-original-title="Select Column" onmouseover="$(this).tooltip('show')"><i class="fa fa-chevron-up"></i></button>
    </div>
    <div class="select-container">
        <div class="row">
            <div class="col-md-2">
                <button class="btn btn-danger btn-xs btn-block btn-filter" data-column='1' type="button">Nama</button>
            </div>
            <div class="col-md-2">
                <button class="btn btn-danger btn-xs btn-block btn-filter" data-column='2' type="button">J. Kelamin</button>
            </div>
            <div class="col-md-2">
                <button class="btn btn-danger btn-xs btn-block btn-filter" data-column='3' type="button">Umur</button>
            </div>
            <div class="col-md-2">
                <button class="btn btn-default btn-xs btn-block btn-filter" data-column='4' type="button">HP</button>
            </div>
            <div class="col-md-2">
                <button class="btn btn-danger btn-xs btn-block btn-filter" data-column='5' type="button">Pend. Terakhir</button>
            </div>
            <div class="col-md-2">
                <button class="btn btn-danger btn-xs btn-block btn-filter" data-column='6' type="button">Jurusan</button>
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-2">
                <button class="btn btn-default btn-xs btn-block btn-filter" data-column='7' type="button">IPK</button>
            </div>
            <!-- <div class="col-md-2">
                <button class="btn btn-default btn-xs btn-block btn-filter" data-column='8' type="button">Lama Studi</button>
            </div> -->
            <div class="col-md-2">
                <button class="btn btn-default btn-xs btn-block btn-filter" data-column='8' type="button">Peng. Kerja</button>
            </div>
            <div class="col-md-2">
                <button class="btn btn-default btn-xs btn-block btn-filter" data-column='9' type="button">Select</button>
            </div>
            <div class="col-md-2">
                <button class="btn btn-default btn-xs btn-block btn-filter" data-column='10' type="button">Option</button>
            </div>
            <div class="col-md-2"></div>
        </div><br>
    </div>
    <hr class="separator invisible">
    <div class="search-container invisible">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <small>Nama</small>
                    <input type="text" class="form-control input-sm text-search" data-column="1">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <small>Jenis Kelamin</small>
                    <select class="form-control input-sm select-search" data-column="2">
                        <option value="">- - Semua - -</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                        option
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <small>Umur</small>
                    <input type="text" class="form-control input-sm text-search" data-column="3">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <small>Nomor HP</small>
                    <input type="text" class="form-control input-sm text-search" data-column="4">
                </div>
            </div>
        </div>     
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <small>Pendidikan Terakhir</small>
                    <select class="form-control input-sm select-search" data-column="5">
                        <option value="">- - Semua - -</option>
                        <option value="1">SMA</option>
                        <option value="2">Diploma</option>
                        <option value="3">Sarjana</option>
                        <option value="4">Pascasarjana</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <small>Jurusan</small>
                    <select name="jurusan" class="form-control input-sm select-search" data-column="6">
                        <option value="">- - Semua - -</option>
                        <?php
                            $sql = "SELECT * FROM tb_jurusan";
                            $query = mysql_query($sql);
                            while($result = mysql_fetch_array($query))
                            {
                                echo "<option value='".$result["jurusan"]."'>".$result["jurusan"]."</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <small>IPK</small>
                    <input type="text" class="form-control input-sm text-search" data-column="7">
                </div>
            </div>
            <!-- <div class="col-md-3">
                <div class="form-group">
                    <small>Lama Studi</small>
                    <input type="text" class="form-control input-sm text-search" data-column="8">
                </div>
            </div> -->
        <!-- </div>      
        <div class="row"> -->
            <div class="col-md-3">
                <div class="form-group">
                    <small>Pengalaman Kerja</small>
                    <input type="text" class="form-control input-sm text-search" data-column="8">
                </div>
            </div>
        </div>             
    </div>
    <hr>
    <div class="col-md-12 text-center" style="margin-top: -37px;">
        <button type="button" class="btn btn-sm btn-default btn-round btn-toggle" data-class="search-container" data-toggle="tooltip" data-placement="top" data-original-title="Advanced Search" onmouseover="$(this).tooltip('show')"><i class="fa fa-chevron-down"></i></button>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3">
            <a class="btn btn-primary btn-block btn-broadcast"><i class="fa fa-envelope-o fa-fw"></i> Broadcast Message</a>
        </div>
        <div class="col-md-3">
            <form action="pelamar-excel" method="post" class="form-excel">
                <input type="hidden" name="query" class="query">
                <input type="hidden" name="excel_field" class="excel_field">
                <button type="button" class="btn btn-primary btn-block btn-export"><i class="fa fa-file-excel-o fa-fw"></i> Export Excel</button>
            </form>
        </div>
        <div class="col-md-3"></div>
    </div>
    <hr>
    <table id="my-table" class="table table-bordered">
        <thead>
            <tr class="center">
                <th>#</th>
                <th class="text-center">Nama</th>
                <th class="text-center">Kelamin</th>
                <th class="text-center">Umur</th>
                <th class="text-center">HP</th>
                <th class="text-center">Pendidikan</th>
                <th class="text-center">Jurusan</th>
                <th class="text-center">IPK</th>
                <!-- <th class="text-center">Lama Studi</th> -->
                <th class="text-center">Pengalaman</th>
                <th class="text-center">Select</th>
                <th class="text-center">Option</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<?php include("includes/footer.php"); ?>

<div id="modal-broadcast" data-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 70%;">
        <div class="modal-content">
            <div class="modal-body">
                <label>Pesan</label> 
                <textarea id="pesan" class="form-control"></textarea>               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-kirim"><i class="fa fa-send fa-fw"></i> Kirim</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var data;
    var lokasi = [];
    var selected = [];
    var excelField = [];
    function kirimPesan(index,id,pesan) {
        $.ajax({
            url: 'kirim-email',
            type: 'POST',
            data: {
                id: id,
                pesan: pesan
            },
        })
        .done(function() {
            console.log('success');
            if(selected[index] == undefined)
            {
                CKEDITOR.instances['pesan'].setData('');
                $('#modal-loading').modal('hide');
                selected = [];
                $('#my-table').find('.terpilih').removeAttr('checked');
                $('#my-table').find('.pilih').css('opacity', '0.2');
            } else
            {
                $('#modal-loading').find('.loading-container').html('Mengirim '+(index+1)+' dari '+selected.length);
                kirimPesan(index+1,selected[index],pesan);                
            }
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });      
    }
    $(document).ready(function() {
        CKEDITOR.replace( 'pesan', {
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
        data = $('#my-table').dataTable({
            "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>" + "<'container-tbl't><br>" + "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            "aoColumns": [
                { "bSearchable": false, "bSortable": true, "bVisible": false },        
                { "bSearchable": true, "bSortable": true },     
                { "bSearchable": true, "bSortable": true, "sClass": "text-center" },     
                { "bSearchable": true, "bSortable": true, "sClass": "text-center" },     
                { "bSearchable": true, "bSortable": true, "sClass": "text-center", "bVisible": false },     
                { "bSearchable": true, "bSortable": true },     
                { "bSearchable": true, "bSortable": true },     
                { "bSearchable": true, "bSortable": true, "sClass": "text-center", "bVisible": false },     
                // { "bSearchable": true, "bSortable": true, "sClass": "text-center", "bVisible": false },     
                { "bSearchable": true, "bSortable": true, "sClass": "text-center", "bVisible": false },    
                { "bSearchable": false, "bSortable": false, "sClass": "text-center td-pilih", "bVisible": false },        
                { "bSearchable": false, "bSortable": false, "sClass": "text-center", "bVisible": false }        
            ],
            "aaSorting": [[ 0, "desc" ]],
            "iDisplayLength": 10,
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "pelamar-tbl",
            "bPaginate": true,
            "bSort": true,
            "bAutoWidth": false,
            "fnServerData": function ( sSource, aoData, fnCallback, oSettings ){
                oSettings.jqXHR = $.ajax({
                    "dataType": 'json',
                    "type": "GET",
                    "url": sSource,
                    "data": aoData,
                    "success": [fnCallback, function(results){
                        $('.query').val(results.sqlQuery);
                    }]
                });
            },
            "fnDrawCallback": function(oSettings){
                // if(oSettings.bSorted || oSettings.bFiltered){
                    for(var i =0, iLen = oSettings.aiDisplay.length; i<iLen; i++){
                        cek = $.inArray($(oSettings.aoData[oSettings.aiDisplay[i]].nTr).find('.terpilih').val(), selected);
                        $(oSettings.aoData[oSettings.aiDisplay[i]].nTr).addClass('mama');
                        if(cek != -1)
                        {
                            $(oSettings.aoData[oSettings.aiDisplay[i]].nTr).find('.terpilih').prop('checked', 'checked');
                            $(oSettings.aoData[oSettings.aiDisplay[i]].nTr).find('.pilih').css('opacity', '1');
                        } else
                        {
                            $(oSettings.aoData[oSettings.aiDisplay[i]].nTr).find('.terpilih').removeAttr('checked');
                            $(oSettings.aoData[oSettings.aiDisplay[i]].nTr).find('.pilih').css('opacity', '0.2');
                        }
                    }
                // }
            }
        });
        $('.search-container').on('keyup', '.text-search', function(event) {
            event.preventDefault();
            data.api().column($(this).data('column')).search($(this).val()).draw();
        });
        $('.search-container').on('change', '.select-search', function(event) {
            event.preventDefault();
            data.api().column($(this).data('column')).search($(this).val()).draw();
        });
        $('.btn-filter').click(function(event) {
            event.preventDefault();
            $(this).toggleClass('btn-default');
            $(this).toggleClass('btn-danger');
            var column = data.api().column($(this).attr('data-column'));
            column.visible(!column.visible()).draw();
            $(this).focusout();
        });
        $('.btn-toggle').click(function(event) {
            className = $(this).data('class');
            that = $(this);
            $('.'+className).slideToggle('slow',function(){
                that.find('i').toggleClass('fa-chevron-down');
                that.find('i').toggleClass('fa-chevron-up');
                if($('.select-container').is(':visible') && $('.search-container').is(':visible'))
                {
                    $('.separator').slideDown('slow');
                } else
                {
                    $('.separator').slideUp('slow');
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
                        url: 'pelamar-act?act=hapus',
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
                            source = [];
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
        $('#my-table').on('click', '.riwayat', function(event) {
            event.preventDefault();
            $.ajax({
                url: 'pelamar-riwayat',
                type: 'POST',
                data: {id: $(this).data('id')},
            })
            .done(function(data) {
                console.log("success");
                $('#modal-container').html(data);
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
        });
        $('#my-table').on('click', '.td-pilih', function(event) {
            event.preventDefault();
            if($(this).find('.terpilih').is(':checked'))
            {
                $(this).find('.terpilih').removeAttr('checked');
                $(this).find('.pilih').css('opacity', '0.2');
                selected.splice(selected.indexOf($(this).find('.terpilih').val()),1);
            } else
            {
                $(this).find('.terpilih').prop('checked', 'checked');
                $(this).find('.pilih').css('opacity', '1');                
                selected.push($(this).find('.terpilih').val());
            }
            console.log(selected);
        });
        $('#my-table').on('mouseover', '.td-pilih', function(event) {
            event.preventDefault();
            if(!$(this).find('.terpilih').is(':checked'))
            {
                $(this).find('.pilih').css('opacity', '1');         
            }
        });
        $('#my-table').on('mouseout', '.td-pilih', function(event) {
            event.preventDefault();
            if($(this).find('.terpilih').is(':checked'))
            {
                $(this).find('.pilih').css('opacity', '1');         
            } else
            {
                $(this).find('.pilih').css('opacity', '0.2');
            }
        });
        $('.btn-broadcast').click(function(event) {
            bootbox.confirm("Yakin kirim pesan broadcast?", function(result) {
                if(result == true)
                {
                    if(selected.length == 0)
                    {
                        bootbox.alert('Tidak ada pelamar yang ditandai.');
                    } else
                    {
                        $('#modal-broadcast').modal('show');
                    }                    
                } else
                {
                    Example.show("Pengiriman dibatalkan.");
                }
            });
        });
        $('#modal-broadcast').on('click', '.btn-kirim', function(event) {
            event.preventDefault();
            if(CKEDITOR.instances['pesan'].getData() == '')
            {
                Example.show('Isi pesan tidak boleh kosong.');
            } else
            {
                $('#modal-broadcast').modal('hide');
                $('#modal-loading').find('.loading-container').html('Mengirim 1 dari '+selected.length);
                $('#modal-loading').modal('show');
                kirimPesan(1,selected[0],CKEDITOR.instances['pesan'].getData());
            }
        });
        $('.btn-export').click(function(event) {
            that = $(this);
            that.html('').html('<i class="fa fa-spinner fa-spin fa-fw"></i>');
            excelField = [];
            for (var i = 1; i <= 8; i++) {
                if(data.api().column(i).visible())
                {
                    excelField.push(i);
                }
            };
            $('.excel_field').val(excelField.toString());
            $('.form-excel').submit();
            setTimeout(function(){
                that.html('<i class="fa fa-file-excel-o fa-fw"></i> Export Excel'); 
            },2000);
        });
        $('#my-table').on('click', '.detail', function(event) {
            event.preventDefault();
            that = $(this);
            $.ajax({
                url: 'pelamar-detail',
                type: 'POST',
                data: {
                    id: that.data('id')
                },
            })
            .done(function(data) {
                console.log("success");
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