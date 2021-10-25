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
                    $sql = "SELECT *,DATE_FORMAT(updated_at,'%d %b %Y') AS updated_at FROM tb_pengumuman WHERE id='".$_GET["display"]."'";
                    $query = mysql_query($sql);
                    $pengumuman = mysql_fetch_array($query)
                    ?>
                    <div class="container-agency">
                        <div class="row">
                            <div class="col-lg-12">
                                <h1 class="section-heading"><?php echo $pengumuman['judul_pengumuman']; ?></h1>
                                <hr class="heading-line">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 agenda-placer">
                                <div class="agenda-heading-placer">
                                    <p class="agenda-posted text-muted"><i class="fa fa-calendar calendar-width"></i> Posted on <?php echo $pengumuman['updated_at']; ?></p>
                                </div>
                                <div class="agenda-news ck-editor-placer text-justify">
                                    <?php echo $pengumuman['pengumuman'] ?>
                                </div>
                                <?php
                                $sql_file = "SELECT  * FROM tb_pengumuman_files WHERE id_pengumuman = '".$pengumuman['id']."'";
                                $query_file = mysql_query($sql_file);

                                ?>
                                <div class="class='well file-pengumuman">
                                <?php
                                $li = 1;
                                while($result_file = mysql_fetch_array($query_file))
                                {
                                    $file = explode("/", $result_file["file"]);
                                    ?>
                                        <dl class="dl-horizontal file-load">
                                            <dt class="text-left">Nama</dt>
                                            <dd><?php echo $result_file["nama_file"] ?></dd>
                                            <dt class="text-left">File</dt>
                                            <dd><?php echo ($file[2]) ?></dd>
                                            <dt class="text-left">Link</dt>
                                            <dd><a href="<?php echo $result_file["file"] ?>"><i class='fa fa-download'></i> Download</a></dd>
                                        </dl>
                                    <?php
                                    $li++;
                                }
                                if ($li == 1) {
                                    echo "<div class='file-load'>No file.</div>";
                                }
                                ?>
                                </div>
                            </div>
                        </div>
                        <hr class="agenda-read-more-line">
                    </div>
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
                                        <h3 class="section-heading">Pengumuman Terkait</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <?php
                                        $sql = "SELECT *,DATE_FORMAT(updated_at,'%d %b %Y') AS updated_at FROM tb_pengumuman WHERE id!='".$_GET["display"]."' ORDER BY updated_at DESC";
                                        $query = mysql_query($sql);
                                        $i_rel = 1;
                                        while ($result = mysql_fetch_array($query)) {
                                            if ($i_rel<=3) {
                                                ?>
                                                <div class="col-md-4 col-sm-4 col-xs-6">
                                                    <div class="thumbnail">
                                                        <div class="caption">
                                                            <h3><?php echo $result['judul_pengumuman'] ?></h3>
                                                            <?php echo wordsLimit($result['pengumuman'],40) ?>
                                                            <p><a href="pengumuman-detail?display=<?php echo $result['id'] ?>" class="btn btn-primary" role="button">View</a></p>
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