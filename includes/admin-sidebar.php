
<div class="col-md-3">
    <div class="container-sidebar">
        <section class="side-section">
            
            <?php
                $sqlID = "SELECT * FROM tb_user WHERE id='$_SESSION[loginID]'";
                $queryID = mysql_query($sqlID);
                $resultID = mysql_fetch_array($queryID);
            ?>

            <!-- account panel -->
            <div class="panel">
                <div class="panel-heading">Akun Anda</div>
                <div class="panel-body text-right">
                    <h4 class="side-name"><?php echo $resultID["username"] ?></h4>
                    <p class="text-right">
                        Selamat datang di halaman website PT. Selaras Mitra Integra.
                    </p>
                    <div>
                        <a class="btn btn-success" href="administrator/index">Halaman Administrator</a>
                    </div>
                </div>
                <div class="panel-footer">
                    <div>
                        <a class="pull-right logout read-more" href="#">Log Out</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <!-- galeri panel -->
            <div class="panel galeri-panel">
                <div class="panel-heading">Pangumuman Terbaru</div>
                <?php 
                    // Select galeri
                    $sql = "SELECT *,DATE_FORMAT(updated_at,'%d %b %Y') AS updated_at FROM tb_pengumuman ORDER BY updated_at DESC";
                    $query = mysql_query($sql);
                    $count = mysql_num_rows($query);
                    if ($count <= 0) {
                    ?>
                        <div class="alert alert-info text-center">
                            <h3 class="text-center">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-square-o fa-stack-2x"></i>
                                    <i class="fa fa-info fa-stack-1x"></i>
                                </span>
                            </h3>
                            Mohon maaf, untuk sementara daftar pengumuman tidak bisa ditampilkan.
                        </div>
                    <?php
                    }else{
                        ?>
                        <div class="panel-body">
                            <?php
                            $i = 1;
                            while ($galeri = mysql_fetch_array($query)) {
                                if ($i <= 5) {
                                    // if ($galeri['image'] == '') {
                                    //     $image = "img/no-image.jpg";
                                    // }else{
                                    //     $image = $galeri['image'];
                                    // }
                                    ?>
                                        <div class="media">
                                            <h5 class="media-heading"><a href="pengumuman-detail?display=<?php echo $galeri['id'] ?>"><?php echo $galeri['judul_pengumuman']; ?></a></h5>
                                            <span class="read-more text-muted"><i class="fa fa-calendar calendar-width"></i>Posted on <?php echo $galeri['updated_at']; ?></span>
                                            <!-- <div class="media-body">
                                                <p>
                                                <img class="media-object pull-left" width="50px" src="<?php echo $image; ?>">
                                                    <?php 
                                                        $text = $galeri['deskripsi'];
                                                        echo wordsLimit($text,20)." ...";
                                                    ?>
                                                    <a class="read-more" href="">[selengkapnya]</a>
                                                    <br>
                                                </p>
                                            </div> -->
                                        </div>
                                    <?php
                                    $i++;
                                }
                            }
                            ?>
                        </div>
                        <div class="panel-footer text-right">
                            <a href="agenda" class="read-more">Lihat semua</a>
                        </div>
                        <?php
                    }
                ?>
            </div>

            <!-- agenda panel -->
            <div class="panel">
                <div class="panel-heading">Agenda Terbaru</div>
                <?php 
                    // Select agenda
                    $sql = "SELECT *,DATE_FORMAT(updated_at,'%d %b %Y') AS updated_at FROM tb_agenda ORDER BY updated_at DESC";
                    $query = mysql_query($sql);
                    $count = mysql_num_rows($query);
                    if ($count <= 0) {
                    ?>
                        <div class="alert alert-info text-center">
                            <h3 class="text-center">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-square-o fa-stack-2x"></i>
                                    <i class="fa fa-info fa-stack-1x"></i>
                                </span>
                            </h3>
                            Mohon maaf, untuk sementara daftar agenda tidak bisa ditampilkan.
                        </div>
                    <?php
                    }else{
                    ?>
                        <div class="panel-body"> 
                            <?php
                            $i=1;
                            while ($agenda = mysql_fetch_array($query)) {
                                if ($i<=3) {
                                ?>
                                    <a href="agenda-detail?display=<?php echo $agenda['id']; ?>">
                                        <div class="pengumuman-list">
                                            <h5><?php echo $agenda['judul']; ?></h5>
                                            <span class="text-muted"><i class="fa fa-calendar calendar-width"></i>Posted on <?php echo $agenda['updated_at']; ?></span>
                                        </div>
                                    </a>
                                    <div class="media-body">
                                        <?php 
                                            $text = $agenda['deskripsi'];
                                            echo wordsLimit($text,20);
                                        ?>
                                        <a class="read-more" href="agenda-detail?display=<?php echo $agenda['id']; ?>">[selengkapnya]</a>
                                        <br>
                                    </div>
                                <?php
                                }
                                $i++;
                            }
                        ?>
                        </div>
                        <div class="panel-footer text-right">
                            <a href="agenda" class="read-more">Lihat semua</a>
                        </div>
                    <?php
                    }
                ?>
            </div>
        </section>
    </div>
</div>
        