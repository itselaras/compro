<?php 
    include("includes/header.php");

    if (isset($_SESSION['pelamarID'])) {
        $pelamar_value = $_SESSION['pelamarID'];
    }else{
        $pelamar_value = '';
    }
?>

    <div class="container container-index">
        <div class="row">
            <div class="col-md-9">
                <span id="loading-page"><img src="img/load.gif"><br>Load detail lowongan</span>
                <section id="agenda" class="agenda-detail karir invisible" style="display:none">
                <?php 
                    // Select Karir
                    $sql = "SELECT a.*, a.id AS lowongan_id, DATE_FORMAT(tanggal,'%d %b %Y') AS tanggal, b.bidang_bisnis, c.logo, c.id AS id_perusahaan, c.perusahaan, d.fungsi_kerja, e.posisi_kerja, f.level_jabatan FROM tb_lowongan a
                        LEFT JOIN tb_struktur_bidang_bisnis b ON b.id = a.id_bidang_perusahaan
                        LEFT JOIN tb_klien c ON c.id = a.id_klien
                        LEFT JOIN tb_struktur_fungsi_kerja d ON d.id = a.id_function
                        LEFT JOIN tb_struktur_posisi_kerja e ON e.id = a.id_posisi
                        LEFT JOIN tb_struktur_level_jabatan f ON f.id = a.id_jabatan
                        WHERE a.status = 1 AND a.id = '".$_GET["display"]."'";
                    $query = mysql_query($sql);
                    $karir = mysql_fetch_array($query);
                    $logo = ($karir['logo']=='') ? "img/no-image.jpg" : $karir['logo'] ;
                    ?>
                    <div class="container-agency container-karir">
                        <div class="row">
                            <div class="col-sm-3 col-xs-12 klien-item">
                                <div class="klien-item-placer">
                                    <div class="klien-link">
                                        <div class="klien-logo-placer" style="background-image: url('<?php echo $logo; ?>');"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-9 col-xs-12 lowongan-klien-placer">
                                <h3 class="section-heading"><?php echo $karir['perusahaan']; ?> <small><a href="klien-detail?display=<?php echo $karir['id_perusahaan'] ?>" data-toggle="tooltip" data-placement="top" data-original-title="Profil Perusahaan" onmouseover="$(this).tooltip('show')"><i class="fa fa-tags"></i></a></small></h3>
                                <h6 class="text-muted"><i class="fa fa-calendar"></i> Posted on <?php echo $karir['tanggal'] ?> | <i class="fa fa-tag"></i> Lowongan ID : <?php echo $karir['lowongan_id'] ?></h6>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3 col-xs-12 category"><b>Bidang</b></div>
                            <div class="col-sm-9 col-xs-12 value-category"><?php echo $karir['bidang_bisnis'] ?></div>
                        
                            <div class="col-sm-3 col-xs-12 category"><b>Spesialisasi</b></div>
                            <div class="col-sm-9 col-xs-12 value-category"><?php echo $karir['fungsi_kerja'] ?></div>
                        
                            <div class="col-sm-3 col-xs-12 category"><b>Posisi Kerja</b></div>
                            <div class="col-sm-9 col-xs-12 value-category"><?php echo $karir['posisi_kerja'] ?></div>
                        
                            <div class="col-sm-3 col-xs-12 category"><b>Level Jabatan</b></div>
                            <div class="col-sm-9 col-xs-12 value-category"><?php echo $karir['level_jabatan'] ?></div>
                        </div>
                        <hr>
                        <div class="agenda-news ck-editor-placer text-justify">
                            <h4>DESKRIPSI</h4>
                            <?php echo $karir['deskripsi_pekerjaan'] ?>
                        </div>
                        <hr>
                        <span id="loading" class="invisible" style="display:none"><img src="img/load.gif"><br>Load pelamar status</span>
                        <div class="status-placer">
                        </div>
                        <hr>
                    </div>
                </section>
            </div>
            
            <?php cekSidebar(); ?>

        </div>
    </div>

<?php include("includes/footer.php") ?>

<div class="modal fade" id="register-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Information</h4>
            </div>
            <div class="modal-body">
                <h6>Account tidak dikenali.</h6>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-primary login-link">Login</a>
                <a href="register" class="btn btn-info">Signup</a>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    var pelamar_value = '<?php echo $pelamar_value ?>';

    function displayStatus(){
        $('.status-placer').html('');
        $('#loading').removeClass('invisible').fadeIn('fast');
        $.ajax({
            url: 'submit-lowongan',
            type: 'POST',
            data: {
                action: 'display_status',
                lowongan_id: '<?php echo $_GET["display"] ?>',
                pelamar_id: pelamar_value
            },
        })
        .done(function(data) {
            // console.log("success");
            $('#loading').addClass('invisible').fadeOut('fast', function(){
                $('.status-placer').html(data);
                $('#loading-page').addClass('invisible').fadeOut('fast', function(){
                    $('#agenda').removeClass('invisible').fadeIn('fast');
                });
            });
        })
        .fail(function() {
            // console.log("error");
        })
        .always(function() {
            // console.log("complete");
        });
    }

    $(document).ready(function() {
        displayStatus();

        $('.karir').on('click', '.reg-apply', function(event) {
            $.ajax({
                url: 'submit-lowongan',
                type: 'POST',
                data: {
                    lowongan_id: '<?php echo $_GET["display"] ?>',
                    action: 'insert'
                },
            })
            .done(function(data) {
                // console.log("success");
                if (data=='success') {
                    displayStatus();
                };
            })
            .fail(function() {
                // console.log("error");
            })
            .always(function() {
                // console.log("complete");
            });
            return false;
        });

        $('.karir').on('click', '.dot-apply', function(event) {
            event.preventDefault();
            $('#register-modal').modal('show');
        });

        $('#register-modal').on('click', '.login-link', function(event) {
            event.preventDefault();
            $('#register-modal').modal('hide');
            $('.container').find('.username-login').focus();
        });
    });

</script>