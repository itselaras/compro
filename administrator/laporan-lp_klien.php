<?php 
    include("includes/header.php"); 
    cekLogin(array('1'));  
    $tahun = date('Y');
    $tahun_awal = mysql_fetch_array(mysql_query("SELECT MIN(DATE(tanggal)) AS tahun_awal FROM tb_lowongan"));
?>

<style type="text/css">
    #chart-container text[text-anchor="middle"]{
      opacity: 0;
    }
</style>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class="fa fa-area-chart"></i> Laporan Lowongan</h1>
        </div>
    </div>
        <?php
            $sql = "SELECT count(id) AS klien FROM tb_klien";
            $query = mysql_query($sql);
            $result = mysql_fetch_array($query);
        ?>
        <i class="fa fa-users"></i> Total klien : <?php echo number_format($result["klien"]) ?>
        <br><br>
        <div class="row">
            <div class="form-group col-xs-4">
                <label>Perusahaan</label>
                <input type="hidden" class="id-perusahaan" name="id-perusahaan">
                <div class="input-group">
                    <span class="input-group-btn">
                        <button class="btn btn-default btn-perusahaan" type="button"><i class="fa fa-plus-circle"></i></button>
                    </span>
                    <input type="text" name="perusahaan" class="form-control nama-perusahaan" disabled="disabled" required>
                    <span class="input-group-btn">
                        <button class="btn btn-default reset-perusahaan" type="button"><i class="fa fa-minus-circle"></i></button>
                    </span>
                </div>
                <span class="help-block">Kosongkan untuk melihat statistik semua perusahaan dalam tanggal/bulan/tahun tunggal.</span>
            </div>            
        </div>
        <div class="row">
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
                    <input type="text" class="form-control hari_awal">
                    <span class="input-group-addon"><i class="fa fa-arrows-h"></i></span>
                    <input type="text" class="form-control hari_akhir akhir">
                </div>
            </div>
        </div>
        <div class="invisible pilih-periode bulan row">
            <div class="col-xs-4">
                <label>Rentang Bulan</label>
                <div class="input-daterange input-bulan input-group">
                    <input type="text" class="form-control bulan_awal">
                    <span class="input-group-addon"><i class="fa fa-arrows-h"></i></span>
                    <input type="text" class="form-control bulan_akhir akhir">
                </div>
            </div>
        </div>
        <div class="invisible pilih-periode tahun row">
            <div class="col-xs-4">
                <label>Rentang Tahun</label>
                <div class="input-daterange input-tahun input-group">
                    <input type="text" class="form-control tahun_awal">
                    <span class="input-group-addon"><i class="fa fa-arrows-h"></i></span>
                    <input type="text" class="form-control tahun_akhir akhir">
                </div>
            </div>
        </div>
        <hr>
        <div class="chart-canvas invisible">
            <div class="col-xs-12 well text-center">
            <label>Pertumbuhan Lowongan Kerja Perusahaan</label>
                <div id="chart-container" style="height: 300px;"></div>
            </div>
        </div>
</div>

<?php include("includes/footer.php"); ?>

<div id="modal-form" data-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <table id="my-table" class="table table-bordered table-hover table-nopadding">
                    <thead>
                        <tr class="center">
                            <th>#</th>
                            <th class="text-center">Perusahaan Klien</th>
                            <th class="text-center" width="15%">Option</th>
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
    var chart = [];
    var perusahaan = [];
    var bar = '';
    var d = new Date();
    var month = d.getMonth()+1;
    var day = d.getDate();
    var fullDate = d.getFullYear() + '-' + (month<10 ? '0' : '') + month + '-' + (day<10 ? '0' : '') + day;
    $(document).ready(function() {
        $('.btn-perusahaan').click(function(event) {
            action = 'perusahaan';
            $('#modal-form').modal('show');
            if(perusahaan == '')
            {
                perusahaan = $('#my-table').dataTable({
                    "aoColumns": [
                        { "bSearchable": false, "bSortable": false, "sClass": "text-center", "bVisible": false},        
                        { "bSearchable": true, "bSortable": true },     
                        { "bSearchable": false, "bSortable": false, "sClass": "text-center", "bVisible": false }        
                    ],
                    "aaSorting": [[ 1, "asc" ]],
                    "iDisplayLength": 10,
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "klien-tbl?act=lowongan",
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
            if(perusahaan != '' && action == 'perusahaan')
            {
                perusahaan.fnNewAjax( "klien-tbl?act=lowongan" );
            }
        });
        $('#modal-form').on('click', '.pilih-perusahaan', function(event) {
            event.preventDefault();
            $('.id-perusahaan').val($(this).data("id"));
            $('.nama-perusahaan').val($(this).data("nama"));
            $('#modal-form').modal('hide');
            $('.akhir').removeAttr('disabled');
            $('.akhir').attr('readonly', 'readonly');
        });
        $('.reset-perusahaan').click(function(event) {
            $('.nama-perusahaan').val('');
            $('.id-perusahaan').val('');
            $('.akhir').attr('disabled', 'disabled');
            $('.akhir').removeAttr('readonly');
            $('.akhir').val('');
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
            $('.chart-canvas').fadeOut('400');
            that = $(this);
            $('.pilih-periode').hide();
            if($(this).val() == '')
            {
                $('.btn-report').attr('disabled', 'disabled');
            } else
            {
                $('.btn-report').removeAttr('disabled');
                if($('.id-perusahaan').val() == undefined || $('.id-perusahaan').val() == '')
                {
                    $('.akhir').attr('disabled', 'disabled');
                    $('.akhir').removeAttr('readonly');                
                    $('.akhir').val('');   
                } else
                {
                    $('.akhir').removeAttr('disabled');                
                    $('.akhir').attr('readonly', 'readonly');
                }                
                $('.'+that.val()).slideDown('slow');
            }
        });
        $('.btn-report').click(function(event) {
            aktif = $('.tipe-laporan').val();
            if($('.'+aktif+'_awal').val() == '' || ($('.'+aktif+'_akhir').is('[readonly]') && $('.'+aktif+'_akhir').val() == ''))
            {
                bootbox.alert('Mohon melengkapi periode laporan berdasarkan '+aktif+'.');
            } else
            {
                $('.chart-canvas').fadeIn('400');
                chart = [];
                $.ajax({
                    url: 'laporan-lp_klien-get_data',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        tipe: aktif,
                        perusahaan: $('.id-perusahaan').val(),
                        awal: $('.'+aktif+'_awal').val(),
                        akhir: $('.'+aktif+'_akhir').val(),
                        auth: '<?php echo $_SESSION["loginID"] ?>'
                    },
                })
                .done(function(data) {
                    console.log("success");
                    $.each(data, function(index, val) {
                         chart.push(val);
                    });
                    if(bar == '')
                    {
                        bar = Morris.Bar({
                            element: 'chart-container',
                            data: chart,
                            barSizeRatio: 0.1,
                            xkey: 'nama',
                            ykeys: ['banyak'],
                            labels: ['Banyak lowongan'],
                            xLabelAngle: 90,
                            hideHover: true,
                            gridIntegers: true,
                            ymin: 0
                        });
                    } else
                    {
                        bar.setData(chart);
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
    });
</script>