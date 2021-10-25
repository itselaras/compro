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
                    $sql = "SELECT *,DATE_FORMAT(updated_at,'%d %b %Y') AS updated_at FROM tb_agenda WHERE id='".$_GET["display"]."'";
                    $query = mysql_query($sql);
                    $agenda = mysql_fetch_array($query)
                    ?>
                    <div class="container-agency">
                        <div class="row">
                            <div class="col-lg-12">
                                <h1 class="section-heading"><?php echo $agenda['judul']; ?></h1>
                                <hr class="heading-line">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 agenda-placer">
                                <div class="agenda-heading-placer">
                                    <p class="agenda-posted text-muted"><i class="fa fa-calendar calendar-width"></i> Posted on <?php echo $agenda['updated_at']; ?></p>
                                </div>
                                <div class="agenda-news ck-editor-placer text-justify">
                                    <?php echo $agenda['deskripsi'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="agenda-read-more-line">
                </section>
                <?php 
                    $query_pag_num = "SELECT COUNT(*) AS count FROM tb_agenda";
                    $result_pag_num = mysql_query($query_pag_num);
                    $row = mysql_fetch_array($result_pag_num);
                    $count = $row['count'];
                    if ($count>1) {
                        ?>
                        <section id="agenda" class="agenda-detail">
                            <div class="container-agency">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h3 class="section-heading">Agenda Terkait</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <?php
                                        $sql = "SELECT *,DATE_FORMAT(updated_at,'%d %b %Y') AS updated_at FROM tb_agenda WHERE id!='".$_GET["display"]."' ORDER BY updated_at DESC";
                                        $query = mysql_query($sql);
                                        $i_rel = 1;
                                        while ($result = mysql_fetch_array($query)) {
                                            if ($i_rel<=3) {
                                                ?>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                    <div class="thumbnail">
                                                        <div class="caption">
                                                            <h3><?php echo $result['judul'] ?></h3>
                                                            <?php echo wordsLimit($result['deskripsi'],30) ?>
                                                            <p><a href="agenda-detail?display=<?php echo $result['id'] ?>" class="btn btn-primary" role="button">View</a></p>
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

<script type="text/javascript">

    $(document).ready(function() {
        
    });

</script>