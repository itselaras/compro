<?php 
    include("includes/header.php"); 
    cekLogin(array('1'));  
    $tahun = date('Y');
    $tahun_awal = mysql_fetch_array(mysql_query("SELECT MIN(DATE(created_at)) AS tahun_awal FROM tb_user WHERE type='2'"));
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class="fa fa-area-chart"></i> Laporan Akun</h1>
        </div>
    </div>
        <?php
            $sql = "SELECT count(id) AS pelamar FROM tb_user WHERE type='2'";
            $query = mysql_query($sql);
            $result = mysql_fetch_array($query);
        ?>
        <i class="fa fa-users"></i> Total akun pelamar : <?php echo number_format($result["pelamar"]) ?>
        <br><br>
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
            <div class="col-xs-12 well text-center">
            <label>Pertumbuhan Akun</label>
                <div id="chart-container" style="height: 400px;"></div>
            </div>
        </div>
        <div class="chart-canvas invisible">
            <div class="col-xs-12 well text-center">
            <label>Statistik Tingkat Pendidikan Akun</label>
                <div id="pendidikan-container" style="height: 400px;"></div>
            </div>
        </div>
</div>

<?php include("includes/footer.php"); ?>

<script type="text/javascript">
    $(document).ready(function() {
        var chart = [];
        var bar = '';
        var chartPendidikan = [];
        var barPendidikan = '';
        var d = new Date();
        var month = d.getMonth()+1;
        var day = d.getDate();
        var fullDate = d.getFullYear() + '-' + (month<10 ? '0' : '') + month + '-' + (day<10 ? '0' : '') + day;
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
                chartPendidikan = [];
                $.ajax({
                    url: 'laporan-lp_pelamar-get_data',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        tipe: aktif,
                        awal: $('.'+aktif+'_awal').val(),
                        akhir: $('.'+aktif+'_akhir').val(),
                        auth: '<?php echo $_SESSION["loginID"] ?>'
                    },
                })
                .done(function(data) {
                    console.log("success");
                    $.each(data.pelamar, function(index, val) {
                         chart.push(val);
                    });
                    $.each(data.pendidikan, function(index, val) {
                         chartPendidikan.push(val);
                    });
                    if(bar == '' && barPendidikan == '')
                    {
                        bar = Morris.Bar({
                            element: 'chart-container',
                            data: chart,
                            barSizeRatio: 0.1,
                            xkey: 'tanggal',
                            ykeys: ['banyak'],
                            labels: ['Total pelamar'],
                            xLabelAngle: 90,
                            hideHover: true,
                            gridIntegers: true,
                            ymin: 0
                        });
                        barPendidikan = Morris.Bar({
                            element: 'pendidikan-container',
                            data: chartPendidikan,
                            barSizeRatio: 0.1,
                            xkey: 'tingkatan',
                            ykeys: ['banyak'],
                            labels: ['Banyak'],
                            hideHover: true,
                            gridIntegers: true,
                            ymin: 0
                        });
                    } else
                    {
                        bar.setData(chart);
                        barPendidikan.setData(chartPendidikan);
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