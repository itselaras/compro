<?php 
	session_start();
	include("administrator/includes/connection.php");
    include("administrator/includes/function.php");
	include("includes/function.php");

	$action = $_POST['action'];

	switch ($action) {
		case 'agenda':
			$page = $_POST['page'];
			$cur_page = $page;
			$next_page = $page+1;
			$pre_page = $page-1;
			$page -= 1;
			$per_page = 4;
			$start = $page * $per_page;
			$rmore = false;
			$lmore = false;

//             for ($i=0; $i < 30; $i++) { 
//                 $sql_in = " INSERT INTO db_smi.tb_lowongan 
//                         (id_bidang_perusahaan, 
//                         id_klien, 
//                         id_function, 
//                         id_posisi, 
//                         id_jabatan, 
//                         deskripsi_pekerjaan, 
//                         gaji, 
//                         syarat_jenis_kelamin, 
//                         syarat_kota, 
//                         syarat_pendidikan, 
//                         syarat_ipk, 
//                         syarat_pengalaman, 
//                         syarat_jurusan, 
//                         syarat_usia
//                         )
//                         VALUES
//                         ('1', 
//                         '2', 
//                         '1', 
//                         '3', 
//                         '5', 
//                         '<p>PT. ASTRA, perusahaan yang bergerak di bidang mengastra astranya astra membuka peluang kerja dengan kriteria pelamar:</p><ul>
//     <li>Menjadi asset berharga bagi masyarakat dan lingkungan disekitar wilayah usahanya</li>
//     <li>Melakukan perbaikan terus menerus dan senantiasa berkembang</li>
//     <li>Melayani pelanggan dengan standard yang tinggi</li>
// </ul>
// ', 
//                         '20000000', 
//                         '2', 
//                         '226', 
//                         '4', 
//                         '4.00', 
//                         '0', 
//                         '0', 
//                         '0'
//                         )";
//                 $query_in = mysql_query($sql_in);

//             }

			$sql = "SELECT *,DATE_FORMAT(updated_at,'%d %b %Y') AS date_updated_at FROM tb_agenda ORDER BY updated_at DESC LIMIT ".$start.", ".$per_page;
            $query = mysql_query($sql);

			$i_agenda=1;
            while ($agenda = mysql_fetch_array($query)) {
            	?>
                <div class="col-md-12 col-sm-12 agenda-placer">
                    <div class="agenda-heading-placer">
                        <h3 class="agenda-heading"><a target="_blank" href="agenda-detail?display=<?php echo $agenda['id']; ?>"><?php echo $agenda['judul']; ?></a></h3>
                        <p class="agenda-posted text-muted"><i class="fa fa-calendar calendar-width"></i> Posted on <?php echo $agenda['date_updated_at']; ?></p>
                    </div>
                    <div class="agenda-news ck-editor-placer text-justify">
                        <?php 
                            $text = $agenda['deskripsi'];
                            $pieces = explode("<p>" , $text);
                            $pTagCount = count($pieces) - 1;
                            if ($pTagCount>2) {
                                $gluedTogetherSpaces = implode("<p>", $pieces);
                                for($i_des = 1; $i_des <= 1; $i_des++){
                                    echo "$pieces[$i_des]";
                                }
                            }else{
                                echo wordsLimit($text,100);
                            }
                        ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="agenda-read-more-placer">
                        <a class="read-more" target="_blank" href="agenda-detail?display=<?php echo $agenda['id']; ?>">Selengkapnya <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
            	<?php
            	$i_agenda++;
            }

            $query_pag_num = "SELECT COUNT(*) AS count FROM tb_agenda";
            $result_pag_num = mysql_query($query_pag_num);
            $row = mysql_fetch_array($result_pag_num);
            $count = $row['count'];
            $no_of_paginations = ceil($count / $per_page);
            ?>
            
        	<div class="col-md-12 col-sm-12 text-right">
            	<hr class="agenda-read-more-line">
	            <ul class="pager">
            	<?php
                    if ($cur_page == $no_of_paginations || $no_of_paginations == 1) {
                        echo "<li class='disabled previous'><span><i class='fa fa-angle-left fa-2x'></i></span></li>";
                    }else{
                        echo "<li class='previous'><a href='#' class='pick-page' data-sub='agenda' data-page='$next_page'><i class='fa fa-angle-left fa-2x'></i></a></li>";
                    }

            		if ($cur_page == 1 || $no_of_paginations == 1) {
            			echo "<li class='disabled next'><span><i class='fa fa-angle-right fa-2x'></i></span></li>";
            		}else{
            			echo "<li class='next'><a href='#' class='pick-page' data-sub='agenda' data-page='$pre_page'><i class='fa fa-angle-right fa-2x'></i></a></li>";
            		}
	            	?>
	            </ul>
        	</div>

            <?php
		    break;

        case 'galeri':
            $page = $_POST['page'];
            $cur_page = $page;
            $next_page = $page+1;
            $pre_page = $page-1;
            $page -= 1;
            $per_page = 6;
            $start = $page * $per_page;
            $rmore = false;
            $lmore = false;

            // Select galeri
            $sql = "SELECT *,DATE_FORMAT(updated_at,'%d %b %Y') AS date_updated_at FROM tb_galeri ORDER BY updated_at DESC LIMIT ".$start.", ".$per_page;
            $query = mysql_query($sql);

            $i_galeri=1;
            while ($galeri = mysql_fetch_array($query)) {
                if ($galeri['image'] == '') {
                    $image = "img/no-image.jpg";
                }else{
                    $image = $galeri['image'];
                }
                ?>
                <div class="col-md-4 col-sm-4 col-xs-12 portfolio-item">
                    <div class="portfolio-item-placer">
                        <a target="_blank" href="galeri-detail?display=<?php echo $galeri['id']; ?>" data-id="<?php echo $galeri['id'] ?>" class="portfolio-link">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content">
                                    <h4>
                                        <span class="fa-stack fa-lg">
                                            <i class="fa fa-circle fa-stack-2x back-port-i"></i>
                                            <i class="fa fa-link fa-stack-1x fa-inverse fo-port-i"></i>
                                        </span>
                                        <h4>Detail</h4>
                                    </h4>
                                </div>
                            </div>
                            <div class="img-responsive-placer klien-logo-placer" style="background-image: url('<?php echo $image ?>')"></div>
                        </a>
                    </div>
                </div>
                <?php
                $i_galeri++;
            }

            $query_pag_num = "SELECT COUNT(*) AS count FROM tb_galeri";
            $result_pag_num = mysql_query($query_pag_num);
            $row = mysql_fetch_array($result_pag_num);
            $count = $row['count'];
            $no_of_paginations = ceil($count / $per_page);
            ?>
            
            <div class="col-md-12 col-sm-12 text-right">
                <hr class="agenda-read-more-line">
                <ul class="pager">
                <?php
                    if ($cur_page == $no_of_paginations || $no_of_paginations == 1) {
                        echo "<li class='disabled previous'><span><i class='fa fa-angle-left fa-2x'></i></span></li>";
                    }else{
                        echo "<li class='previous'><a href='#' class='pick-page' data-sub='galeri' data-page='$next_page'><i class='fa fa-angle-left fa-2x'></i></a></li>";
                    }

                    if ($cur_page == 1 || $no_of_paginations == 1) {
                        echo "<li class='disabled next'><span><i class='fa fa-angle-right fa-2x'></i></span></li>";
                    }else{
                        echo "<li class='next'><a href='#' class='pick-page' data-sub='galeri' data-page='$pre_page'><i class='fa fa-angle-right fa-2x'></i></a></li>";
                    }
                    ?>
                </ul>
            </div>

            <?php
            break;
		
        case 'umum':
            $page = $_POST['page'];
            $cur_page = $page;
            $next_page = $page+1;
            $pre_page = $page-1;
            $page -= 1;
            $per_page = 4;
            $start = $page * $per_page;
            $rmore = false;
            $lmore = false;

            // Select pengumuman
            $sql = "SELECT *,DATE_FORMAT(updated_at,'%d %b %Y') AS date_updated_at FROM tb_pengumuman ORDER BY updated_at DESC LIMIT ".$start.", ".$per_page;
            $query = mysql_query($sql);

            $i_umum=1;
            while ($pengumuman = mysql_fetch_array($query)) {
                ?>
                <div class="col-md-12 col-sm-12 agenda-placer">
                    <div class="agenda-heading-placer">
                        <h3 class="agenda-heading"><a target="_blank" href="pengumuman-detail?display=<?php echo $pengumuman['id']; ?>"><?php echo $pengumuman['judul_pengumuman']; ?></a></h3>
                        <p class="agenda-posted text-muted"><i class="fa fa-calendar calendar-width"></i> Posted on <?php echo $pengumuman['date_updated_at']; ?></p>
                    </div>
                    <div class="agenda-news ck-editor-placer text-justify">
                        <?php 
                            $text = $pengumuman['pengumuman'];
                            $pieces = explode("<p>" , $text);
                            $pTagCount = count($pieces) - 1;
                            if ($pTagCount>2) {
                                $gluedTogetherSpaces = implode("<p>", $pieces);
                                for($i = 1; $i <= 2; $i++){
                                    echo "$pieces[$i]";
                                }
                            }else{
                                echo wordsLimit($text,100);
                            }
                            ?>
                    </div>
                    <div class="clearfix"></div>
                    <!-- <hr class="agenda-read-more-line"> -->
                    <div class="agenda-read-more-placer">
                        <a target="_blank" class="read-more" href="pengumuman-detail?display=<?php echo $pengumuman['id']; ?>">Selengkapnya <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
                <?php
                $i_umum++;
            }

            $query_pag_num = "SELECT COUNT(*) AS count FROM tb_pengumuman";
            $result_pag_num = mysql_query($query_pag_num);
            $row = mysql_fetch_array($result_pag_num);
            $count = $row['count'];
            $no_of_paginations = ceil($count / $per_page);
            ?>
            
            <div class="col-md-12 col-sm-12 text-right">
                <hr class="agenda-read-more-line">
                <ul class="pager">
                <?php
                    if ($cur_page == $no_of_paginations || $no_of_paginations == 1) {
                        echo "<li class='disabled previous'><span><i class='fa fa-angle-left fa-2x'></i></span></li>";
                    }else{
                        echo "<li class='previous'><a href='#' class='pick-page' data-sub='umum' data-page='$next_page'><i class='fa fa-angle-left fa-2x'></i></a></li>";
                    }

                    if ($cur_page == 1 || $no_of_paginations == 1) {
                        echo "<li class='disabled next'><span><i class='fa fa-angle-right fa-2x'></i></span></li>";
                    }else{
                        echo "<li class='next'><a href='#' class='pick-page' data-sub='umum' data-page='$pre_page'><i class='fa fa-angle-right fa-2x'></i></a></li>";
                    }
                    ?>
                </ul>
            </div>

            <?php
            break;
		default:
			# code...
			break;
	}
?>