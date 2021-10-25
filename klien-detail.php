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
                    $sql = "SELECT * FROM tb_klien WHERE id='".$_GET["display"]."'";
                    $query = mysql_query($sql);
                    $klien = mysql_fetch_array($query);
                    if ($klien['logo'] == '') {
                        $image = "img/no-image.jpg";
                    }else{
                        $image = $klien['logo'];
                    }
                    ?>
                    <div class="container-agency">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <h1 class="section-heading"><?php echo $klien['perusahaan']; ?></h1>
                                <hr class="heading-line">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4 agenda-placer">
                                <div class="klien-link">
                                    <div class="klien-logo-placer" style="background-image: url('<?php echo $image; ?>');"></div>
                                </div>
                            </div>
                            <!-- <div class="col-md-8 col-sm-8 agenda-placer">
                                <div class="agenda-news ck-editor-placer text-justify">
                                    <?php echo $klien['deskripsi'] ?>
                                </div>
                            </div> -->
                        </div>
                    </div>
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