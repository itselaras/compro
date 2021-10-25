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
                    <?php
                        $status_next='';
                        $status_pre='';
                        $sql_next = "SELECT * FROM tb_agenda WHERE id > '".$_GET["display"]."' ORDER BY id LIMIT 1;";
                        $query_next = mysql_query($sql_next);
                        $next = mysql_fetch_array($query_next);
                        if ($next['id']=='') {
                            $status_next='disabled';
                        }

                        $sql_pre = "SELECT * FROM tb_agenda WHERE id < '".$_GET["display"]."' ORDER BY id LIMIT 1;";
                        $query_pre = mysql_query($sql_pre);
                        $pre = mysql_fetch_array($query_pre);
                        if ($pre['id']=='') {
                            $status_pre='disabled';
                        }
                    ?>
                    <ul class="pager">
                        <li class="previous <?php echo $status_pre ?>"><a href="agenda-detail?display=<?php echo $pre['id'] ?>"><i class="fa fa-angle-left fa-2x"></i></a></li>
                        <li class="next <?php echo $status_next ?>"><a href="agenda-detail?display=<?php echo $next['id'] ?>"><i class="fa fa-angle-right fa-2x"></i></a></li>
                    </ul>
                </section>
            </div>
            
            <?php cekSidebar(); ?>

        </div>
    </div>

<?php include("includes/footer.php") ?>

<script type="text/javascript">

    $(document).ready(function() {
        
    });

</script>