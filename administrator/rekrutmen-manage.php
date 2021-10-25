<?php 
    include("includes/header.php"); 
    cekLogin(array('1'));
    if(!isset($_GET["id"]))
    {
        header("Location: rekrutmen");
    }
    $sql = "SELECT a.id_klien,a.awal_berlaku,a.akhir_berlaku,c.perusahaan,b.bidang_bisnis,d.fungsi_kerja,e.posisi_kerja,f.level_jabatan
        FROM tb_lowongan a
        LEFT JOIN tb_struktur_bidang_bisnis b ON a.id_bidang_perusahaan=b.id
        LEFT JOIN tb_klien c ON a.id_klien=c.id
        LEFT JOIN tb_struktur_fungsi_kerja d ON a.id_function=d.id
        LEFT JOIN tb_struktur_posisi_kerja e ON a.id_posisi=e.id
        LEFT JOIN tb_struktur_level_jabatan f ON a.id_jabatan=f.id
        WHERE a.id='".$_GET["id"]."'";
    $query = mysql_query($sql);
    $lowongan = mysql_fetch_array($query);
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class="fa fa-tags"></i> Manajemen Pelamar</h1>
        </div>
    </div>
    <ol class="breadcrumb text-right">
        <li><a href="rekrutmen">Manajemen Pelamar</a></li>
        <li class="active">Manage</li>
    </ol>
    <div class="topless">
        <h3 class="topless">
            <?php echo $lowongan["perusahaan"] ?><br>
            <small><?php echo $lowongan["bidang_bisnis"] ?></small><br>
            <small style="font-size: 10pt;"><?php echo $lowongan["fungsi_kerja"] ?> | <?php echo $lowongan["posisi_kerja"] ?> | <?php echo $lowongan["level_jabatan"] ?></small><br>
            <small style="font-size: 10pt;"><i class="fa fa-calendar"></i> <?php echo date_format(date_create($lowongan["awal_berlaku"]),"d M Y"); ?> - <?php echo date_format(date_create($lowongan["akhir_berlaku"]),"d M Y"); ?></small>
        </h3>
        <input type="hidden" class="id-klien" value="<?php echo $lowongan['id_klien'] ?>">
    </div>
    <div class="filter-container invisible">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <small>Jenis Kelamin</small>
                    <select class="form-control input-sm jenis-kelamin">
                        <option value="">- - Kosong - -</option>
                        <option value="1">Laki-laki</option>
                        <option value="2">Perempuan</option>
                        option
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <small>Pendidikan Terakhir</small>
                    <select class="form-control input-sm pendidikan">
                        <option value="">- - Kosong - -</option>
                        <option value="1">SMA</option>
                        <option value="2">Diploma</option>
                        <option value="3">Sarjana</option>
                        <option value="4">Pascasarjana</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <small>IPK</small>
                    <input type="text" class="form-control input-sm ipk">
                </div>
            </div>
        </div>     
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <small>Pengalaman Kerja (Tahun)</small>
                    <input type="text" class="form-control input-sm pengalaman">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <small>Bidang Keahlian / Jurusan</small>
                    <select name="jurusan" class="form-control input-sm jurusan">
                        <option value="">- - Kosong - -</option>
                        <?php
                            $sql = "SELECT * FROM tb_jurusan";
                            $query = mysql_query($sql);
                            while($result = mysql_fetch_array($query))
                            {
                                $selected = "";
                                if($result["id"] == $edit["syarat_jurusan"])
                                {
                                    $selected = "selected";
                                }
                                echo "<option value='".$result["id"]."' ".$selected.">".$result["jurusan"]."</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <small>Usia (Tahun)</small>
                    <input type="text" class="form-control input-sm usia">
                </div>
            </div>
        </div>  
        <button type="button" class="btn btn-primary btn-update btn-xs"><i class="fa fa-pencil fa-fw"></i> Update</button>
    </div>
    <hr>
    <div class="col-md-12 text-center" style="margin-top: -37px;">
        <button type="button" class="btn btn-sm btn-default btn-round btn-toggle" data-class="search-container" data-toggle="tooltip" data-placement="top" data-original-title="Filter" onmouseover="$(this).tooltip('show')"><i class="fa fa-chevron-down"></i></button>
    </div><br>
    <div class="row text-center">
        <div class="col-xs-3"></div>
        <div class="col-xs-2">
            <button type="button" class="btn btn-primary btn-block btn-xs btn-switch">Switch View</button>
        </div>
        <div class="col-xs-2">
            <button type="button" class="btn btn-primary btn-block btn-xs btn-excel">Export Excel</button>
        </div>
        <div class="col-xs-2">
            <button type="button" class="btn btn-primary btn-block btn-xs btn-confirm">Konfirmasi</button>
        </div>
        <div class="col-xs-3"></div>
    </div><br>
    <table id="tabel-pelamar" class="table table-bordered">
        <thead>
            <tr class="center">
                <th>#</th>
                <th class="text-center">Nama</th>
                <th class="text-center">Kelamin</th>
                <th class="text-center">Kelamin</th>
                <th class="text-center">Pendidikan</th>
                <th class="text-center">Pendidikan</th>
                <th class="text-center">IPK</th>
                <th class="text-center">IPK</th>
                <th class="text-center">Pengalaman</th>
                <th class="text-center">Pengalaman</th>
                <th class="text-center">Jurusan</th>
                <th class="text-center">Jurusan</th>
                <th class="text-center">Usia</th>
                <th class="text-center">Usia</th>
                <th class="text-center">Status</th>
                <th class="text-center">Option</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<?php include("includes/footer.php"); ?>

<div id="modal-eksport" data-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form method="post" action="rekrutmen-manage-excel">
                <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
                <div class="form-group">
                    <label>Status Pelamar</label> 
                    <select class="form-control" name="status_pelamar">
                        <option value="">Semua</option>
                        <option value="1">Diterima</option>
                        <option value="0">Tidak diterima</option>
                    </select>                        
                </div>
                <label>Field</label>
                <div class="row">
                    <input type="hidden" name="perusahaan" value="<?php echo $lowongan['perusahaan'] ?>">
                    <input type="hidden" name="bidang_bisnis" value="<?php echo $lowongan['bidang_bisnis'] ?>">
                    <input type="hidden" name="fungsi_kerja" value="<?php echo $lowongan['fungsi_kerja'] ?>">
                    <input type="hidden" name="posisi_kerja" value="<?php echo $lowongan['posisi_kerja'] ?>">
                    <input type="hidden" name="level_jabatan" value="<?php echo $lowongan['level_jabatan'] ?>">
                    <input type="hidden" name="masa_berlaku" value="<?php echo date_format(date_create($lowongan['awal_berlaku']),'d M Y').' - '.date_format(date_create($lowongan['akhir_berlaku']),'d M Y') ?>">
                    <div class="col-md-6">
                        <div class="checkbox">
                            <label><input type="checkbox" checked="checked" value="1" class="check-field" name="selectedField[]"> Nama</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" checked="checked" value="2" class="check-field" name="selectedField[]"> Jenis kelamin</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value="3" class="check-field" name="selectedField[]"> HP</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" checked="checked" value="4" class="check-field" name="selectedField[]"> Pendidikan terakhir</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" checked="checked" value="5" class="check-field" name="selectedField[]"> Bidang Keahlian/Jurusan</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="checkbox">
                            <label><input type="checkbox" checked="checked" value="6" class="check-field" name="selectedField[]"> IPK</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value="7" class="check-field" name="selectedField[]"> Lama Studi</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" checked="checked" value="8" class="check-field" name="selectedField[]"> Pengalaman kerja</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" checked="checked" value="9" class="check-field" name="selectedField[]"> Usia</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value="10" class="check-field" name="selectedField[]"> Status penerimaan</label>
                        </div>
                    </div>
                </div>      
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-send"><i class="fa fa-file-excel-o fa-fw"></i> Export</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div id="modal-broadcast" data-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 70%;">
        <div class="modal-content">
            <div class="modal-body">
                <label>Pesan Konfirmasi</label> 
                <textarea id="pesan" rows="5" class="form-control pesan"></textarea>               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-kirim"><i class="fa fa-send fa-fw"></i> Kirim</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var data = [];
    var pelamar = [];
    var field = [];
    var pelamarDiterima = [];
    function loadFilter() {
        $.ajax({
            url: 'rekrutmen-act?act=filter',
            type: 'POST',
            dataType: 'json',
            data: {
                id: '<?php echo $_GET["id"] ?>',
                auth: '<?php echo $_SESSION["loginID"] ?>'
            },
        })
        .done(function(data) {
            console.log("success");
            $('.jenis-kelamin').val(data.jenisKelamin);
            $('.pendidikan').val(data.pendidikan);
            $('.ipk').val(data.ipk);
            $('.pengalaman').val(data.pengalaman);
            $('.jurusan').val(data.jurusan);
            $('.usia').val(data.usia);
            if(pelamar == '')
            {
                pelamar = $('#tabel-pelamar').dataTable({
                    "aoColumns": [
                        { "bSearchable": false, "bSortable": true, "sClass": "text-center", "bVisible": false},        
                        { "bSearchable": true, "bSortable": true },          
                        { "bSearchable": false, "bSortable": false, "sClass": "text-center" },     
                        { "bSearchable": true, "bSortable": true, "sClass": "text-center", "bVisible": false },     
                        { "bSearchable": false, "bSortable": false, "sClass": "text-center" },     
                        { "bSearchable": true, "bSortable": true, "bVisible": false },     
                        { "bSearchable": false, "bSortable": false, "sClass": "text-center" },     
                        { "bSearchable": true, "bSortable": true, "sClass": "text-center", "bVisible": false },     
                        { "bSearchable": false, "bSortable": false, "sClass": "text-center" },     
                        { "bSearchable": true, "bSortable": true, "sClass": "text-center", "bVisible": false },     
                        { "bSearchable": false, "bSortable": false, "sClass": "text-center" },     
                        { "bSearchable": true, "bSortable": true, "bVisible": false },     
                        { "bSearchable": false, "bSortable": false, "sClass": "text-center" },     
                        { "bSearchable": true, "bSortable": true, "sClass": "text-center", "bVisible": false },     
                        { "bSearchable": false, "bSortable": false, "sClass": "text-center", "bVisible": false },     
                        { "bSearchable": false, "bSortable": false, "sClass": "text-center" }        
                    ],
                    "aaSorting": [[ 1, "asc" ]],
                    "iDisplayLength": 10,
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "rekrutmen-tbl?id=<?php echo $_GET['id'] ?>&jenisKelamin="+data.jenisKelamin+"&pendidikan="+data.pendidikan+"&ipk="+data.ipk+"&pengalaman="+data.pengalaman+"&jurusan="+data.jurusan+"&usia="+data.usia,
                    "bPaginate": true,
                    "bSort": true,
                    "bAutoWidth": false,
                    "fnServerData": function( sSource, aoData, fnCallback ){                           
                        $.getJSON( sSource, aoData, function (json) {
                            fnCallback(json);
                        });
                    }
                });
            } else
            {
                pelamar.fnNewAjax( "rekrutmen-tbl?id=<?php echo $_GET['id'] ?>&jenisKelamin="+data.jenisKelamin+"&pendidikan="+data.pendidikan+"&ipk="+data.ipk+"&pengalaman="+data.pengalaman+"&jurusan="+data.jurusan+"&usia="+data.usia );
            }
            $('#modal-loading').modal('hide');          
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
    }
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
            if(pelamarDiterima[index] == undefined)
            {
                $.ajax({
                    url: 'rekrutmen-act?act=fixed',
                    type: 'POST',
                    data: {
                        idLowongan: '<?php echo $_GET["id"] ?>',
                        auth: '<?php echo $_SESSION["loginID"] ?>'
                    },
                })
                .done(function() {
                    console.log("success");
                    CKEDITOR.instances['pesan'].setData('');
                    $('#modal-loading').modal('hide');
                    pelamarDiterima = [];
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    console.log("complete");
                });
            } else
            {
                $('#modal-loading').find('.loading-container').html('Mengirim '+(index+1)+' dari '+pelamarDiterima.length);
                kirimPesan(index+1,pelamarDiterima[index],pesan);                
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
        $('#modal-loading').find('.loading-container').html('Loading filter...');
        $('#modal-loading').modal('show');
        setTimeout(function(){
            loadFilter();
        },1000);
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
        $('.btn-toggle').click(function(event) {
            $('.filter-container').slideToggle('slow');
            $(this).find('i').toggleClass('fa-chevron-down');
            $(this).find('i').toggleClass('fa-chevron-up');
        });
        $('.btn-update').click(function(event) {
            var formVal = '';
            formVal = {
                id           : '<?php echo $_GET["id"] ?>',
                jenisKelamin : $('.jenis-kelamin').val(),
                pendidikan   : $('.pendidikan').val(),
                ipk          : $('.ipk').val().toString().replace(/,/g,'.'),
                pengalaman   : $('.pengalaman').val(),
                jurusan      : $('.jurusan').val(),
                usia         : $('.usia').val(),
                auth         : '<?php echo $_SESSION["loginID"] ?>'
            }
            if((formVal.ipk != '') && (formVal.ipk/formVal.ipk != 1))
            {
                bootbox.alert('Input IPK harus berupa bilangan. Mohon cek kembali.');
            } else if((formVal.pengalaman != '') && (formVal.pengalaman/formVal.pengalaman != 1))
            {
                bootbox.alert('Input Pengalaman Kerja harus berupa bilangan. Mohon cek kembali.');
            } else if((formVal.usia != '') && (formVal.usia/formVal.usia != 1))
            {
                bootbox.alert('Input Usia harus berupa bilangan. Mohon cek kembali.');
            } else if((formVal.ipk != '') && (formVal.ipk/formVal.ipk != 1))
            {
                bootbox.alert('Input IPK harus berupa bilangan. Mohon cek kembali.');
            } else
            {
                $('#modal-loading').find('.loading-container').html('Updating filter...');
                $('#modal-loading').modal('show');
                setTimeout(function(){
                    $.ajax({
                        url: 'rekrutmen-act?act=update',
                        type: 'POST',
                        data: formVal,
                    })
                    .done(function() {
                        console.log("success");
                        $('#modal-loading').find('.loading-container').html('Filtering...');
                        setTimeout(function(){
                            loadFilter();                            
                        },1000)
                    })
                    .fail(function() {
                        console.log("error");
                    })
                    .always(function() {
                        console.log("complete");
                    });
                },1000);
            }
        });
        $('#tabel-pelamar').on('click', '.riwayat', function(event) {
            event.preventDefault();
            $.ajax({
                url: 'pelamar-riwayat',
                type: 'POST',
                data: {
                    id: $(this).data('id'),
                    idKlien: $('.id-klien').val(),
                    idLowongan: '<?php echo $_GET["id"] ?>'
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
        $('#tabel-pelamar').on('click', '.response', function(event) {
            event.preventDefault();
            that = $(this);
            $.ajax({
                url: 'rekrutmen-act?act=response',
                type: 'POST',
                data: {
                    idPelamar: that.data('id'),
                    idLowongan: '<?php echo $_GET["id"] ?>',
                    action: that.data('action'),
                    auth: '<?php echo $_SESSION["loginID"] ?>'
                },
            })
            .done(function(data) {
                console.log("success");
                pelamar.fnStandingRedraw();
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
        });
        $('#tabel-pelamar').on('click', '.nama_detail', function(event) {
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
        $('.btn-switch').click(function(event) {
            for (var i = 2; i <= 13; i++) {
                var column = pelamar.api().column(i);
                column.visible(!column.visible()).draw();                
            };
        });
        $('.btn-excel').click(function(event) {
            $('#modal-eksport').modal('show');
            $(this).html('').html('<i class="fa fa-spinner fa-spin fa-fw"></i>');
        });
        $('.btn-send').click(function(event) {
            $('#modal-eksport').modal('hide');
            setTimeout(function(){
                $('.btn-excel').html('').html('Export Excel');
            },1000);
        });
        $('.btn-confirm').click(function(event) {
            $('#modal-broadcast').modal('show');
            $('#modal-broadcast').on('shown.bs.modal', function(event) {
                event.preventDefault();
                $('.pesan').focus();
            });
        });
        $('#modal-broadcast').on('click', '.btn-kirim', function(event) {
            event.preventDefault();
            bootbox.confirm("Yakin mengirim pesan konfirmasi?", function(result) {
                if(result == true)
                {
                    $.ajax({
                        url: 'rekrutmen-act?act=accepted',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            idLowongan: '<?php echo $_GET["id"] ?>',
                            pesan: CKEDITOR.instances['pesan'].getData(),
                            auth: '<?php echo $_SESSION["loginID"] ?>'
                        },
                    })
                    .done(function(data) {
                        console.log("success");
                        pelamarDiterima = data;
                        if(CKEDITOR.instances['pesan'].getData() == '')
                        {
                            Error.show('Isi pesan tidak boleh kosong.');
                        } else if(pelamarDiterima.length == 0)
                        {
                            Error.show('Tidak ada pelamar yang diterima.');
                            $('#modal-broadcast').modal('hide');
                        } else
                        {
                            $('#modal-broadcast').modal('hide');
                            $('#modal-loading').find('.loading-container').html('Mengirim 1 dari '+pelamarDiterima.length);
                            $('#modal-loading').modal('show');
                            kirimPesan(1,pelamarDiterima[0],CKEDITOR.instances['pesan'].getData());
                        }
                    })
                    .fail(function() {
                        console.log("error");
                    })
                    .always(function() {
                        console.log("complete");
                    });
                    
                } else
                {
                    Example.show("Pengiriman pesan dibatalkan.");
                }
            });
        }); 
    });
</script>