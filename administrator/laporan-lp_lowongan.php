<?php 
    include("includes/header.php"); 
    cekLogin(array('1'));  
    $tahun = date('Y');
    $tahun_awal = mysql_fetch_array(mysql_query("SELECT MIN(DATE(tanggal)) AS tahun_awal FROM tb_lowongan"));
?>

<style type="text/css">
    #chart-perusahaan text[text-anchor="middle"], 
    #chart-penerimaan text[text-anchor="middle"]{
      opacity: 0;
    }
</style>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class="fa fa-area-chart"></i> Laporan Pelamar</h1>
        </div>
    </div>
        <?php
            $sql = "SELECT count(id) AS lowongan FROM tb_lowongan";
            $query = mysql_query($sql);
            $result = mysql_fetch_array($query);
        ?>
        <i class="fa fa-users"></i> Total lowongan pekerjaan : <?php echo number_format($result["lowongan"]) ?>
        <br><br>
        <div class="row">
            <div class="form-group col-xs-6">
                <label>Lowongan</label>
                <input type="hidden" class="id-lowongan" name="id-lowongan">
                <div class="input-group">
                    <span class="input-group-btn">
                        <button class="btn btn-default btn-lowongan" type="button"><i class="fa fa-plus-circle"></i></button>
                    </span>
                    <input type="text" name="lowongan" class="form-control nama-lowongan" disabled="disabled" required>
                    <span class="input-group-btn">
                        <button class="btn btn-default reset-lowongan" type="button"><i class="fa fa-minus-circle"></i></button>
                    </span>
                </div>
                <span class="help-block">Kosongkan untuk melihat statistik semua lowongan. Pengisian untuk melihat statistik lowongan terpilih.</span>
            </div>            
            <div class="form-group col-xs-4">
                <label>Laporan</label>
                <div class="row">
                    <div class="col-xs-7">
                        <select class="form-control tipe-laporan">
                            <option value="">- - Pilih Periode - -</option>
                            <option value="hari">Harian</option>
                            <option value="bulan">Bulanan</option>
                            <option value="tahun">Tahunan</option>
                        </select>            
                        
                    </div>
                    <div class="col-xs-5">
                        <a href="#" class="btn btn-default btn-report btn-block" disabled="disabled"><i class="fa fa-external-link fa-fw"></i> OK</a>                                    
                    </div>
                </div>
            </div>         
        </div>
        <div class="invisible pilih-periode hari row">
            <div class="col-xs-4">
                <label>Rentang Tanggal</label>
                <div class="input-daterange input-tanggal input-group">
                    <input type="text" class="form-control hari_awal" readonly="readonly">
                    <span class="input-group-addon"><i class="fa fa-arrows-h"></i></span>
                    <input type="text" class="form-control hari_akhir" readonly="readonly">
                </div>
            </div>
        </div>
        <div class="invisible pilih-periode bulan row">
            <div class="col-xs-4">
                <label>Rentang Bulan</label>
                <div class="input-daterange input-bulan input-group">
                    <input type="text" class="form-control bulan_awal" readonly="readonly">
                    <span class="input-group-addon"><i class="fa fa-arrows-h"></i></span>
                    <input type="text" class="form-control bulan_akhir" readonly="readonly">
                </div>
            </div>
        </div>
        <div class="invisible pilih-periode tahun row">
            <div class="col-xs-4">
                <label>Rentang Tahun</label>
                <div class="input-daterange input-tahun input-group">
                    <input type="text" class="form-control tahun_awal" readonly="readonly">
                    <span class="input-group-addon"><i class="fa fa-arrows-h"></i></span>
                    <input type="text" class="form-control tahun_akhir" readonly="readonly">
                </div>
            </div>
        </div>
        <hr>
        <div class="chart-canvas invisible">
            <div class="row main-chart">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Total Lowongan
                            <div class="pull-right">
                                <select class="form-control input-sm dr-lowongan" style="width: 100px; height: 22px; padding: 0px;"></select>
                            </div>
                        </div>
                        <div class="panel-body" id="chart-lowongan" style="height: 300px;">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Perusahaan
                        </div>
                        <div class="panel-body text-center" id="chart-perusahaan" style="height: 300px;"></div>
                    </div>                        
                </div>
            </div>      
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Penerimaan
                        </div>
                        <div class="panel-body" id="chart-penerimaan" style="height: 300px;"></div>
                    </div>     
                </div>
            </div>
        </div>
</div>

<?php include("includes/footer.php"); ?>

<div id="modal-form" data-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 80%;">
        <div class="modal-content">
            <div class="modal-body">
                <table id="my-table" class="table table-bordered table-hover">
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
                            <th class="text-center">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var lowongan = [];
    var chart = [];
    var chartPerusahaan = [];
    var chartPenerimaan = [];
    var bar = '';
    var barPerusahaan = '';
    var barPenerimaan = '';
    var d = new Date();
    var month = d.getMonth()+1;
    var day = d.getDate();
    var fullDate = d.getFullYear() + '-' + (month<10 ? '0' : '') + month + '-' + (day<10 ? '0' : '') + day;
    $(document).ready(function() {
        $('.btn-lowongan').click(function(event) {
            $('#modal-form').modal('show');
            if(lowongan == '')
            {
                lowongan = $('#my-table').dataTable({
                    "aoColumns": [
                        { "bSearchable": false, "bSortable": true, "sClass": "text-center", "bVisible": false },        
                        { "bSearchable": true, "bSortable": true },     
                        { "bSearchable": true, "bSortable": true },     
                        { "bSearchable": true, "bSortable": true },     
                        { "bSearchable": true, "bSortable": true },     
                        { "bSearchable": true, "bSortable": true },     
                        { "bSearchable": true, "bSortable": true, "bVisible": false },     
                        { "bSearchable": false, "bSortable": false, "sClass": "text-center" },     
                        { "bSearchable": false, "bSortable": false, "bVisible": false }  
                    ],
                    "aaSorting": [[ 1, "asc" ]],
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
                    }
                });
            }
            if(lowongan != '')
            {
                lowongan.fnNewAjax( "lowongan-tbl" );
            }
        });
        $('#modal-form').on('click', 'tbody tr', function(event) {
            event.preventDefault();
            if($('.tipe-laporan').val() != '')
            {
                $('.'+$('.tipe-laporan').val()).fadeOut('400');                
            }
            $('.tipe-laporan').val('').attr('disabled', 'disabled');
            idLowongan = $(this).find('.id-lowongan').data('id');
            bidangBisnis = $(this).find('.id-lowongan').data('nama');
            $('.id-lowongan').val(idLowongan);
            $('.nama-lowongan').val(bidangBisnis);
            $('.btn-report').removeAttr('disabled');
            $('#modal-form').modal('hide');
            $('.chart-canvas').fadeOut('400');
            $('.main-chart').addClass('invisible');
        });
        $('.reset-lowongan').click(function(event) {
            $('.nama-lowongan').val('');
            $('.id-lowongan').val('');
            $('.tipe-laporan').removeAttr('disabled');
            if($('.tipe-laporan').val() == '')
            {
                $('.btn-report').attr('disabled', 'disabled');                
            }
            $('.main-chart').removeClass('invisible');
            $('.chart-canvas').fadeOut('400');
        });
        $(".input-tanggal").datepicker({
            format: "yyyy-mm-dd",
            startDate: "<?php echo $tahun_awal['tahun_awal'] ?>",
            endDate: fullDate,
            autoclose: true,
            todayHighlight: true
        });
        $(".input-bulan").datepicker({
            format: "yyyy-mm-dd",
            startDate: "<?php echo $tahun_awal['tahun_awal'] ?>",
            endDate: fullDate,
            startView: 1,
            minViewMode: 1,
            autoclose: true,
            todayHighlight: true
        });
        $(".input-tahun").datepicker({
            format: "yyyy-mm-dd",
            startDate: "<?php echo $tahun_awal['tahun_awal'] ?>",
            endDate: fullDate,
            startView: 2,
            minViewMode: 2,
            autoclose: true,
            todayHighlight: true
        });
        $('.tipe-laporan').change(function(event) {
            chart = [];
            chartPerusahaan = [];
            chartPenerimaan = [];
            if(barPerusahaan != '')
            {
                barPerusahaan.setData('');                
            }
            if(barPenerimaan != '')
            {
                barPenerimaan.setData('');                
            }
            $('.chart-canvas').fadeOut('400');
            that = $(this);
            $('.pilih-periode').hide();
            if($(this).val() == '')
            {
                $('.btn-report').attr('disabled', 'disabled');
            } else
            {
                $('.btn-report').removeAttr('disabled');                
                $('.'+that.val()).slideDown('slow');                
            }
        });
        $('.btn-report').click(function(event) {
            aktif = $('.tipe-laporan').val();
            if($('.'+aktif+'_awal').val() == '' || $('.'+aktif+'_akhir').val() == '')
            {
                bootbox.alert('Mohon melengkapi periode laporan berdasarkan '+aktif+'.');
            } else
            {
                $('.chart-canvas').fadeIn('400');
                chart = [];
                chartPerusahaan = [];
                chartPenerimaan = [];
                $('.dr-lowongan').html('').append($("<option></option>").attr("value","").text("Tanggal"));
                $.ajax({
                    url: 'laporan-lp_lowongan-get_data',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        tipe: aktif,
                        lowonganPilih: $('.id-lowongan').val(),
                        awal: $('.'+aktif+'_awal').val(),
                        akhir: $('.'+aktif+'_akhir').val(),
                        auth: '<?php echo $_SESSION["loginID"] ?>'
                    },
                })
                .done(function(data) {
                    console.log("success");
                    if(data.param == 'lowongan')
                    {
                        // bar.setData('');
                        // barPerusahaan.setData('');
                        $.each(data.hasil, function(index, val) {
                            chartPenerimaan.push(val);
                        });
                        if(barPenerimaan == '')
                        {
                            barPenerimaan = Morris.Bar({
                                element: 'chart-penerimaan',
                                data: chartPenerimaan,
                                xkey: 'lowongan',
                                ykeys: ['pelamar','diterima'],
                                labels: ['Lamaran','Diterima'],
                                barSizeRatio:0.3,
                                hideHover: true,
                                gridIntegers: true,
                                ymin: 0
                            });
                        } else
                        {
                            barPenerimaan.setData(chartPenerimaan);
                        }
                    } else
                    {
                        $.each(data.hasil, function(index, val) {
                            chart.push(val);
                        });
                        $.each(data.option, function(index, val) {
                            $('.dr-lowongan').append($("<option></option>").attr("value",val.tanggal).text(val.tampil));
                        });
                        if(bar == '')
                        {
                            bar = Morris.Bar({
                                element: 'chart-lowongan',
                                data: chart,
                                xkey: 'nama',
                                ykeys: ['banyak'],
                                labels: ['Total lowongan'],
                                barSizeRatio:0.3,
                                hideHover: true,
                                xLabelAngle: 90,
                                gridIntegers: true,
                                ymin: 0
                            });
                        } else
                        {
                            bar.setData(chart);
                        }                        
                    }
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    console.log("complete");
                });
            }
        });
        $('.chart-canvas').on('change', '.dr-lowongan', function(event) {
            event.preventDefault();
            that = $(this);
            chartPerusahaan = [];
            chartPenerimaan = [];
            if(that.val() != '')
            {
                $.ajax({
                    url: 'laporan-lp_lowongan-get_data?get=select',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        tanggal: that.val(),
                        tipe: $('.tipe-laporan').val(),
                        auth: '<?php echo $_SESSION["loginID"] ?>'
                    },
                })
                .done(function(data) {
                    console.log("success");
                    $.each(data.hasil, function(index, val) {
                        chartPerusahaan.push(val);
                    });
                    $.each(data.option, function(index, val) {
                        chartPenerimaan.push(val);
                    });
                    if(barPerusahaan == '')
                    {
                        barPerusahaan = Morris.Bar({
                            element: 'chart-perusahaan',
                            data: chartPerusahaan,
                            xkey: 'perusahaan',
                            ykeys: ['value'],
                            labels: ['Total lowongan'],
                            barSizeRatio:0.3,
                            hideHover: true,
                            gridIntegers: true,
                            ymin: 0
                        });
                    } else
                    {
                        barPerusahaan.setData(chartPerusahaan);
                    }
                    if(barPenerimaan == '')
                    {
                        barPenerimaan = Morris.Bar({
                            element: 'chart-penerimaan',
                            data: chartPenerimaan,
                            xkey: 'lowongan',
                            ykeys: ['pelamar','diterima'],
                            labels: ['Lamaran','Diterima'],
                            barSizeRatio:0.3,
                            hideHover: true,
                            gridIntegers: true,
                            ymin: 0
                        });
                    } else
                    {
                        barPenerimaan.setData(chartPenerimaan);
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
                if(barPenerimaan != '')
                {
                    barPenerimaan.setData('');                    
                }
                if(barPerusahaan != '')
                {
                    barPerusahaan.setData('');                    
                }
            }
        });
    });
</script>