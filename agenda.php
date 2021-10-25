<?php 
    include("includes/header.php");
?>

    <div class="container container-index">
        <div class="row" id="move-content">
            <div class="col-md-9">
                <!-- Agenda Section -->
                <section id="agenda">
                    <div class="container-agency">
                        <div class="row">
                            <div class="col-lg-12">
                                <h2 class="section-heading">Agenda <span class="loading"></span></h2>
                                <hr class="heading-line">
                            </div>
                        </div>
                        <div class="row">
                            <?php 
                                // Select agenda
                                $sql_agenda = "SELECT * FROM tb_agenda";
                                $query_agenda = mysql_query($sql_agenda);
                                $count_agenda = mysql_num_rows($query_agenda);
                                if ($count_agenda <= 0) {
                                ?>
                                    <div class="col-md-12">
                                        <div class="alert alert-info jumbotron">  
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <h2>
                                                        <span class="fa-stack fa-lg">
                                                            <i class="fa fa-square-o fa-stack-2x"></i>
                                                            <i class="fa fa-info fa-stack-1x"></i>
                                                        </span>
                                                    </h2>
                                                </div>
                                                <div class="col-md-10">
                                                    <h1>Informasi!</h1>
                                                    <p>
                                                        Kami mohon maaf, untuk sementara daftar agenda tidak bisa ditampilkan.
                                                        Silahkan coba lagi nanti.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }else{
                                    ?>
                                    <div id="page-agenda"></div>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                </section>
                <section id="umum">
                    <div class="container-agency">
                        <div id="portfolio">
                            <div class="container-agency">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h2 class="section-heading">Pengumuman <span class="loading"></span></h2>
                                        <hr class="heading-line">
                                    </div>
                                </div>
                                <div class="row">
                                    <?php 
                                        // Select galeri
                                        $sql_umum = "SELECT id FROM tb_pengumuman ORDER BY updated_at DESC";
                                        $query_umum = mysql_query($sql_umum);
                                        $count_umum = mysql_num_rows($query_umum);
                                        if ($count_umum <= 0) {
                                        ?>
                                            <div class="col-md-12">
                                                <div class="alert alert-info jumbotron">  
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <h2>
                                                                <span class="fa-stack fa-lg">
                                                                    <i class="fa fa-square-o fa-stack-2x"></i>
                                                                    <i class="fa fa-info fa-stack-1x"></i>
                                                                </span>
                                                            </h2>
                                                        </div>
                                                        <div class="col-md-10">
                                                            <h1>Informasi!</h1>
                                                            <p>
                                                                Kami mohon maaf, untuk sementara daftar pengumuman tidak bisa ditampilkan.
                                                                Silahkan coba lagi nanti.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }else{
                                            ?>
                                            <div id="page-umum"></div>
                                            <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="galeri">
                    <div class="container-agency">
                        <div id="portfolio">
                            <div class="container-agency">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h2 class="section-heading">Galeri <span class="loading"></span></h2>
                                        <hr class="heading-line">
                                    </div>
                                </div>
                                <div class="row">
                                    <?php 
                                        // Select galeri
                                        $sql_galeri = "SELECT *,DATE_FORMAT(updated_at,'%d %b %Y') AS updated_at FROM tb_galeri ORDER BY updated_at DESC";
                                        $query_galeri = mysql_query($sql_galeri);
                                        $count_galeri = mysql_num_rows($query_galeri);
                                        if ($count_galeri <= 0) {
                                        ?>
                                            <div class="col-md-12">
                                                <div class="alert alert-info jumbotron">  
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <h2>
                                                                <span class="fa-stack fa-lg">
                                                                    <i class="fa fa-square-o fa-stack-2x"></i>
                                                                    <i class="fa fa-info fa-stack-1x"></i>
                                                                </span>
                                                            </h2>
                                                        </div>
                                                        <div class="col-md-10">
                                                            <h1>Informasi!</h1>
                                                            <p>
                                                                Kami mohon maaf, untuk sementara daftar galeri tidak bisa ditampilkan.
                                                                Silahkan coba lagi nanti.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }else{
                                            ?>
                                            <div id="page-galeri"></div>
                                            <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            
            <?php cekSidebar(); ?>

        </div>
    </div>

<?php include("includes/footer.php") ?>

<script type="text/javascript">

    function loadDataAgenda(page_req, sub){
        $('#'+sub).find('.loading').html('<img src="img/load.gif">').fadeIn('fast');

        $.ajax({
            url: 'display-agenda.php',
            type: 'POST',
            data: {
                page: page_req,
                action: sub
            }
        })
        .done(function(data) {
            // console.log("success");
            $('#'+sub).find('.loading').fadeOut('medium', function(){
                $('#page-'+sub).html(data);
            });
        })
        .fail(function() {
            // console.log("error");
        })
        .always(function() {
            // console.log("complete");
        });
    }

    $(document).ready(function(){

        $('.loading').hide();

        loadDataAgenda(1, 'agenda');
        loadDataAgenda(1, 'galeri');
        loadDataAgenda(1, 'umum');

        $('#move-content').on('click', '.pick-page', function(event) {
            var page = $(this).data('page');
            var sub = $(this).data('sub');
            loadDataAgenda(page, sub);
            return false;
        });
    });

</script>