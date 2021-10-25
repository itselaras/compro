<?php 
    include("includes/header.php");
?>

    <div class="container container-index">
        <div class="row">
            <div class="col-md-9">
                <!-- Agenda Section -->
                <section id="agenda" class="agenda-detail">
                <?php 
                    // Select agenda detail
                    $sql = "SELECT *,DATE_FORMAT(updated_at,'%d %b %Y') AS updated_at FROM tb_galeri WHERE id='".$_GET["display"]."'";
                    $query = mysql_query($sql);
                    $galeri = mysql_fetch_array($query);
                    if ($galeri['image'] == '') {
                        $image = "img/no-image.jpg";
                    }else{
                        $image = $galeri['image'];
                    }
                    ?>
                    <div class="container-agency">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <h1 class="section-heading"><?php echo $galeri['judul']; ?></h1>
                                <hr class="heading-line">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 agenda-placer">
                                <div class="thumbnail">
                                    <img src="<?php echo $image ?>" class="img-responsive">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 agenda-placer">
                                <div class="agenda-heading-placer">
                                    <p class="agenda-posted text-muted"><i class="fa fa-calendar calendar-width"></i> Posted on <?php echo $galeri['updated_at']; ?></p>
                                </div>
                                <div class="agenda-news ck-editor-placer text-justify">
                                    <?php echo $galeri['deskripsi'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="agenda-read-more-line">
                </section>
                <?php 
                    $query_pag_num = "SELECT COUNT(*) AS count FROM tb_galeri";
                    $result_pag_num = mysql_query($query_pag_num);
                    $row = mysql_fetch_array($result_pag_num);
                    $count = $row['count'];
                    if ($count>1) {
                        ?>
                        <section id="agenda" class="agenda-detail">
                            <div class="container-agency">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h3 class="section-heading">Galeri Terkait</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <?php
                                        $sql = "SELECT *,DATE_FORMAT(updated_at,'%d %b %Y') AS updated_at FROM tb_galeri WHERE id!='".$_GET["display"]."' ORDER BY updated_at DESC";
                                        $query = mysql_query($sql);
                                        $i_rel = 1;
                                        while ($result = mysql_fetch_array($query)) {
                                            if ($i_rel<=4) {
                                                $gambar = ($result['image']) ? $result['image'] : 'img/no-image.jpg' ;
                                                ?>
                                                <div class="col-md-3 col-sm-3 col-xs-6">
                                                    <div class="thumbnail related">
                                                        <div class="img-related">
                                                            <div class="related-image-placer" style="background-image: url('<?php echo $gambar ?>')"></div>
                                                        </div>
                                                        <div class="caption">
                                                            <h5><?php echo $result['judul'] ?></h5>
                                                            <?php echo wordsLimit($result['deskripsi'],15) ?>
                                                            <p><a href="galeri-detail?display=<?php echo $result['id'] ?>" class="btn btn-primary" role="button">View</a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            $i_rel++;
                                        }
                                    ?>
                                </div>
                            </div>
                        </section>
                        <?php
                    }
                ?>
            </div>
            
            <?php cekSidebar(); ?>

        </div>
    </div>

<?php include("includes/footer.php") ?>